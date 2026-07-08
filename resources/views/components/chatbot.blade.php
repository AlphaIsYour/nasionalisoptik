<!-- Chatbot Widget -->
<div x-data="chatbot()" x-init="init()" class="fixed bottom-4 right-4 z-50">
    <!-- Chat Button -->
    <button 
        @click="toggleChat()" 
        x-show="!isOpen"
        class="bg-[#70574D] text-white rounded-full p-4 shadow-2xl hover:bg-opacity-90 transition-all duration-300 hover:scale-110"
    >
        <img src="{{ asset('/image/chatbot.png') }}" alt="Chatbot" class="w-10 h-10">
    </button>

    <!-- Chat Window -->
    <div 
        x-show="isOpen" 
        x-transition
        class="bg-white rounded-lg shadow-2xl w-[calc(100vw-32px)] sm:w-96 h-[450px] sm:h-[500px] flex flex-col"
    >
        <!-- Header -->
        <div class="bg-[#70574D] text-white p-4 rounded-t-lg flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full flex items-center justify-center overflow-hidden">
                    <img src="{{ asset('image/cs-chatbot.png') }}" alt="CS" class="w-full h-full object-cover">
                </div>
                <div>
                    <p class="font-bold">Asisten Virtual</p>
                    <p class="text-xs opacity-90">Optik Nasionalis</p>
                </div>
            </div>
            <button @click="toggleChat()" class="hover:bg-white/20 rounded p-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Messages Container -->
        <div 
            x-ref="messagesContainer"
            class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50"
        >
            <!-- Welcome Message -->
            <div class="flex gap-2">
                <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 overflow-hidden">
                    <img src="{{ asset('image/cs-chatbot.png') }}" alt="CS" class="w-full h-full object-cover">
                </div>
                <div class="bg-white rounded-lg p-3 shadow-sm max-w-[75%]">
                    <p class="text-sm text-gray-800">Halo! 👋 Saya asisten virtual Optik Nasionalis. Ada yang bisa saya bantu?</p>
                </div>
            </div>

            <!-- Messages -->
            <template x-for="(message, index) in messages" :key="index">
                <div :class="message.role === 'user' ? 'flex justify-end' : 'flex gap-2'">
                    <!-- Bot Avatar (only for bot messages) -->
                    <div x-show="message.role === 'bot'" class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 overflow-hidden">
                        <img src="{{ asset('image/cs-chatbot.png') }}" alt="CS" class="w-full h-full object-cover">
                    </div>

                    <!-- Message Bubble -->
                    <div 
                        :class="message.role === 'user' 
                            ? 'bg-[#70574D] text-white rounded-lg p-3 shadow-sm max-w-[75%]' 
                            : 'bg-white rounded-lg p-3 shadow-sm max-w-[75%]'"
                    >
                        <p class="text-sm whitespace-pre-wrap" x-text="message.content"></p>
                    </div>
                </div>
            </template>

            <!-- Loading -->
            <div x-show="isLoading" class="flex gap-2">
                <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 overflow-hidden">
                    <img src="{{ asset('image/cs-chatbot.png') }}" alt="CS" class="w-full h-full object-cover">
                </div>
                <div class="bg-white rounded-lg p-3 shadow-sm">
                    <div class="flex gap-1">
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <div class="p-4 border-t border-gray-200 bg-white rounded-b-lg">
            <form @submit.prevent="sendMessage()" class="flex gap-2">
                <input 
                    x-model="inputMessage"
                    type="text" 
                    placeholder="Ketik pesan Anda..."
                    class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#70574D] text-sm"
                    :disabled="isLoading"
                >
                <button 
                    type="submit"
                    :disabled="isLoading || !inputMessage.trim()"
                    class="bg-[#70574D] text-white p-2 rounded-lg hover:bg-opacity-90 transition disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function chatbot() {
    return {
        isOpen: false,
        isLoading: false,
        inputMessage: '',
        messages: [],

        init() {
            // Load messages from localStorage
            try {
                const saved = localStorage.getItem('chatbot_messages');
                if (saved) {
                    this.messages = JSON.parse(saved);
                }
            } catch (error) {
                console.error('Error loading messages:', error);
                this.messages = [];
            }
        },

        toggleChat() {
            this.isOpen = !this.isOpen;
            if (this.isOpen) {
                this.$nextTick(() => {
                    this.scrollToBottom();
                });
            }
        },

        async sendMessage() {
            if (!this.inputMessage.trim() || this.isLoading) return;

            const userMessage = this.inputMessage.trim();
            this.inputMessage = '';

            // Add user message
            this.messages.push({
                role: 'user',
                content: userMessage
            });

            this.saveMessages();
            this.scrollToBottom();

            // Show loading
            this.isLoading = true;

            try {
                // Gunakan URL relatif agar otomatis ikut protocol (http/https)
                const response = await fetch('/chatbot/chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        message: userMessage
                    })
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();

                if (data.success) {
                    // Add bot response
                    this.messages.push({
                        role: 'bot',
                        content: data.message
                    });
                } else {
                    this.messages.push({
                        role: 'bot',
                        content: 'Maaf, saya mengalami kesulitan. Silakan coba lagi.'
                    });
                }

                this.saveMessages();
                this.scrollToBottom();

            } catch (error) {
                console.error('Chat error:', error);
                this.messages.push({
                    role: 'bot',
                    content: 'Maaf, terjadi kesalahan koneksi. Silakan coba lagi.'
                });
                this.saveMessages();
                this.scrollToBottom();
            } finally {
                this.isLoading = false;
            }
        },

        scrollToBottom() {
            this.$nextTick(() => {
                const container = this.$refs.messagesContainer;
                if (container) {
                    container.scrollTop = container.scrollHeight;
                }
            });
        },

        saveMessages() {
            try {
                localStorage.setItem('chatbot_messages', JSON.stringify(this.messages));
            } catch (error) {
                console.error('Error saving messages:', error);
            }
        }
    }
}
</script>