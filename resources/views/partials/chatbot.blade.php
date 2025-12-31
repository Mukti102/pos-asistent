 <button id="chat-toggle"
     class="fixed bottom-6 right-6 p-4 bg-primary text-white rounded-full shadow-2xl hover:bg-primary/40 transition-all z-50 focus:outline-none">
     <svg id="icon-open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
         stroke="currentColor">
         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
             d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
     </svg>
     <svg id="icon-close" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24"
         stroke="currentColor">
         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
     </svg>
 </button>

 <div id="chat-container"
     class="fixed bottom-24 right-6 w-[350px] md:w-[400px] h-[500px] bg-white dark:bg-gray-800 rounded-2xl shadow-2xl flex flex-col hidden overflow-hidden z-50 border border-gray-200 dark:border-gray-700 transition-all duration-300 transform translate-y-4">
     <div class="p-4 bg-primary text-white flex justify-between items-center">
         <div class="flex items-center gap-3">
             <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center font-bold">AI</div>
             <div>
                 <h3 class="text-sm font-bold">Asisten POS</h3>
                 <p class="text-[10px] text-blue-100 flex items-center gap-1">
                     <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span> Online
                 </p>
             </div>
         </div>
     </div>

     <div id="chat-box" class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50 dark:bg-gray-900 scroll-smooth">
         <div class="flex justify-start">
             <div
                 class="max-w-[80%] bg-white dark:bg-gray-800 p-3 rounded-2xl rounded-tl-none shadow-sm text-sm text-gray-700 dark:text-gray-300 border border-gray-100 dark:border-gray-700">
                 Halo! Ada yang bisa saya bantu terkait transaksi hari ini?
             </div>
         </div>
     </div>

     <form id="chat-form" class="p-4 bg-white dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700">
         <div class="relative flex items-center">
             <input type="text" id="message" placeholder="Tulis pertanyaan..."
                 class="w-full pl-4 pr-12 py-3 bg-gray-100 dark:bg-gray-700 border-none rounded-xl text-sm focus:ring-2 focus:ring-blue-500 dark:text-white outline-none">
             <button class="absolute right-2 p-2 text-primary hover:text-primary/50 transition">
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 rotate-90" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         d="M12 19l9-2-9-18-9 18 9 2zm0 0v-8" />
                 </svg>
             </button>
         </div>
     </form>
 </div>

 <script>
     document.addEventListener('DOMContentLoaded', function() {
         const chatToggle = document.getElementById('chat-toggle');
         const chatContainer = document.getElementById('chat-container');
         const iconOpen = document.getElementById('icon-open');
         const iconClose = document.getElementById('icon-close');
         const form = document.getElementById('chat-form');
         const messageInput = document.getElementById('message');
         const chatBox = document.getElementById('chat-box');

         // 1. Toggle Buka/Tutup
         chatToggle.addEventListener('click', () => {
             const isHidden = chatContainer.classList.contains('hidden');
             if (isHidden) {
                 chatContainer.classList.remove('hidden');
                 setTimeout(() => {
                     chatContainer.classList.remove('translate-y-4', 'opacity-0');
                 }, 10);
                 iconOpen.classList.add('hidden');
                 iconClose.classList.remove('hidden');
             } else {
                 chatContainer.classList.add('translate-y-4');
                 setTimeout(() => chatContainer.classList.add('hidden'), 300);
                 iconOpen.classList.remove('hidden');
                 iconClose.classList.add('hidden');
             }
         });

         // 2. Kirim Pesan
         form.addEventListener('submit', async function(e) {
             e.preventDefault();

             const message = messageInput.value.trim();
             if (!message) return;

             // Tampilkan pesan user di UI
             appendMessage('user', message);
             messageInput.value = '';

             try {
                 const res = await fetch('/assistant/chat', {
                     method: 'POST',
                     headers: {
                         'Content-Type': 'application/json',
                         'X-CSRF-TOKEN': '{{ csrf_token() }}'
                     },
                     body: JSON.stringify({
                         message
                     })
                 });

                 const data = await res.json();
                 appendMessage('bot', data.reply);
             } catch (err) {
                console.log(err);
                 appendMessage('bot', 'Maaf, terjadi kesalahan koneksi.');
             }
         });

         // Helper Fungsi untuk append chat balon
        //  function appendMessage(sender, text) {
        //      const isBot = sender === 'bot';
        //      const div = document.createElement('div');
        //      div.className = `flex ${isBot ? 'justify-start' : 'justify-end'}`;

        //      div.innerHTML = `
        //     <div class="max-w-[85%] p-3 text-sm shadow-sm ${
        //         isBot 
        //         ? 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-2xl rounded-tl-none border border-gray-100 dark:border-gray-700' 
        //         : 'bg-blue-600 text-white rounded-2xl rounded-tr-none'
        //     }">
        //         ${text}
        //     </div>
        // `;

        //      chatBox.appendChild(div);
        //      chatBox.scrollTop = chatBox.scrollHeight; // Scroll otomatis ke bawah
        //  }

        function appendMessage(sender, text) {
    const isBot = sender === 'bot';
    const div = document.createElement('div');
    div.className = `flex ${isBot ? 'justify-start' : 'justify-end'}`;

    // Regex untuk mengubah *teks* menjadi <strong>teks</strong>
    // g = global (semua temuan), m = multiline
    const formattedText = text.replace(/\*(.*?)\*/g, '<strong>$1</strong>');

    div.innerHTML = `
        <div class="max-w-[85%] p-3 text-sm shadow-sm ${
            isBot 
            ? 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-2xl rounded-tl-none border border-gray-100 dark:border-gray-700' 
            : 'bg-blue-600 text-white rounded-2xl rounded-tr-none'
        }">
            ${formattedText}
        </div>
    `;

    chatBox.appendChild(div);
    chatBox.scrollTop = chatBox.scrollHeight;
}
     });
 </script>
