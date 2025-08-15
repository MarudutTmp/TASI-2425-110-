<x-app-layout>
    <style>
        /* Animasi Umum */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-15px); }
            60% { transform: translateY(-7px); }
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        @keyframes wiggle {
            0%, 100% { transform: rotate(-3deg); }
            50% { transform: rotate(3deg); }
        }
        
        @keyframes rainbow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* Animasi Kartu Quiz */
        .quiz-card {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            background: white;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .quiz-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 15px 30px rgba(78, 115, 223, 0.2);
        }
        
        .quiz-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #4E73DF, #3D17AE, #7C3AED);
            background-size: 200% 100%;
            animation: rainbow 4s ease infinite;
        }
        
        /* Animasi Title */
        .page-title {
            position: relative;
            display: inline-block;
        }
        
        .page-title::after {
            content: "📝";
            position: absolute;
            right: -40px;
            top: 50%;
            transform: translateY(-50%);
            animation: bounce 2s infinite;
        }
        
        /* Animasi Copy Button */
        .copy-btn {
            transition: all 0.3s ease;
        }
        
        .copy-btn:hover {
            transform: scale(1.2);
        }
        
        .copy-btn:active {
            transform: scale(0.9);
        }
        
        /* Animasi Pesan Copied */
        .copied-message {
            transition: all 0.3s ease;
            opacity: 0;
            height: 0;
            overflow: hidden;
            color: #4E73DF;
            font-weight: bold;
        }
        
        .copied-message.show {
            opacity: 1;
            height: auto;
        }
        
        /* Animasi Start Button */
        .start-btn {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .start-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(78, 115, 223, 0.3);
        }
        
        .start-btn::after {
            content: "🚀";
            position: absolute;
            right: -20px;
            opacity: 0;
            transition: all 0.3s ease;
        }
        
        .start-btn:hover::after {
            right: 10px;
            opacity: 1;
        }
        
        /* Animasi Grid */
        .grid-animation {
            animation: fadeInUp 0.6s ease forwards;
        }
        
        @keyframes fadeInUp {
            from { 
                opacity: 0;
                transform: translateY(20px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Delay untuk animasi grid */
        .quiz-card:nth-child(1) { animation-delay: 0.1s; }
        .quiz-card:nth-child(2) { animation-delay: 0.2s; }
        .quiz-card:nth-child(3) { animation-delay: 0.3s; }
        .quiz-card:nth-child(4) { animation-delay: 0.4s; }
    </style>

    <div class="container mx-auto p-6 bg-white h-full">
        <h1 class="text-2xl font-bold mb-4 page-title">List Quiz Start</h1>

        <div class="grid grid-cols-4 gap-6">
            @foreach ($filteredQuizzes as $quiz)
                <div class="quiz-card grid-animation border rounded-lg text-[12px] text-[#808080] text-center p-[25px]">
                    <!-- Icon Quiz -->
                    <div class="text-4xl mb-3" style="animation: float 3s ease infinite">📚</div>
                    
                    <h2 class="text-[18px] text-black font-semibold">{{ $quiz['nama_quiz'] ?? 'Quiz Name Not Available' }}</h2>
                    
                    <!-- Info Quiz dengan Emoji -->
                    <div class="my-3 flex items-center justify-center">
                        <span class="mr-2">❓</span>
                        <span>Total Questions: {{ $quiz['total_question'] ?? 'N/A' }}</span>
                    </div>
                    <div class="my-2 flex items-center justify-center">
                        <span class="mr-2">⏱️</span>
                        <span>Start: {{ $quiz['start_time'] ?? 'N/A' }}</span>
                    </div>
                    <div class="my-2 flex items-center justify-center">
                        <span class="mr-2">🏁</span>
                        <span>End: {{ $quiz['end_time'] ?? 'N/A' }}</span>
                    </div>

                    <!-- Quiz Code Section -->
                    <div class="mt-4">
                        <label class="font-semibold flex items-center justify-center">
                            <span class="mr-2">🔑</span> Quiz Code:
                        </label>
                        <div class="copied-message text-xs mt-1">Code Copied! ✨</div>
                        <div class="flex items-center border bg-white rounded border-[#80808083] mt-2">
                            <input type="text" value="{{ $quiz['code_quiz'] ?? 'N/A' }}"
                                class="border-none text-center rounded w-full" disabled>
                            <button onclick="copyToClipboard('{{ $quiz['code_quiz'] ?? '' }}', this)"
                                class="h-full bg-white px-2 py-1 cursor-pointer copy-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 48 48">
                                    <path fill="#4E73DF" d="M 18.5 5 C 15.480226 5 13 7.4802259 13 10.5 L 13 32.5 C 13 35.519774 15.480226 38 18.5 38 L 34.5 38 C 37.519774 38 40 35.519774 40 32.5 L 40 10.5 C 40 7.4802259 37.519774 5 34.5 5 L 18.5 5 z M 18.5 8 L 34.5 8 C 35.898226 8 37 9.1017741 37 10.5 L 37 32.5 C 37 33.898226 35.898226 35 34.5 35 L 18.5 35 C 17.101774 35 16 33.898226 16 32.5 L 16 10.5 C 16 9.1017741 17.101774 8 18.5 8 z M 11 10 L 9.78125 10.8125 C 8.66825 11.5545 8 12.803625 8 14.140625 L 8 33.5 C 8 38.747 12.253 43 17.5 43 L 30.859375 43 C 32.197375 43 33.4465 42.33175 34.1875 41.21875 L 35 40 L 17.5 40 C 13.91 40 11 37.09 11 33.5 L 11 10 z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Start Button -->
                    <form action="{{ route('quiz.start', ['quizId' => $quiz['id']]) }}" method="POST">
                        @csrf
                        <button class="start-btn bg-[#4E73DF] text-white px-4 py-2 cursor-pointer rounded mt-4 w-full">
                            Start Quiz
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        function copyToClipboard(code, buttonElement) {
            navigator.clipboard.writeText(code).then(() => {
                const card = buttonElement.closest('.quiz-card');
                const copiedMessage = card.querySelector('.copied-message');
                
                // Animasi tombol copy
                buttonElement.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="#10B981">
                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                    </svg>
                `;
                
                setTimeout(() => {
                    buttonElement.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 48 48">
                            <path fill="#4E73DF" d="M 18.5 5 C 15.480226 5 13 7.4802259 13 10.5 L 13 32.5 C 13 35.519774 15.480226 38 18.5 38 L 34.5 38 C 37.519774 38 40 35.519774 40 32.5 L 40 10.5 C 40 7.4802259 37.519774 5 34.5 5 L 18.5 5 z M 18.5 8 L 34.5 8 C 35.898226 8 37 9.1017741 37 10.5 L 37 32.5 C 37 33.898226 35.898226 35 34.5 35 L 18.5 35 C 17.101774 35 16 33.898226 16 32.5 L 16 10.5 C 16 9.1017741 17.101774 8 18.5 8 z M 11 10 L 9.78125 10.8125 C 8.66825 11.5545 8 12.803625 8 14.140625 L 8 33.5 C 8 38.747 12.253 43 17.5 43 L 30.859375 43 C 32.197375 43 33.4465 42.33175 34.1875 41.21875 L 35 40 L 17.5 40 C 13.91 40 11 37.09 11 33.5 L 11 10 z"></path>
                        </svg>
                    `;
                }, 2000);
                
                // Tampilkan pesan copied
                if (copiedMessage) {
                    copiedMessage.classList.add('show');
                    setTimeout(() => {
                        copiedMessage.classList.remove('show');
                    }, 3000);
                }
            });
        }

        // Animasi tambahan saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            // Tambahkan emoji acak saat hover kartu
            const quizCards = document.querySelectorAll('.quiz-card');
            
            quizCards.forEach((card, index) => {
                // Tambahkan delay berbeda untuk setiap kartu
                card.style.animationDelay = `${index * 0.1}s`;
                
                card.addEventListener('mouseenter', function() {
                    const emojis = ['📚', '🎓', '🧠', '✏️', '📝', '🔍', '🌟'];
                    const emoji = emojis[Math.floor(Math.random() * emojis.length)];
                    
                    const emojiElement = document.createElement('div');
                    emojiElement.textContent = emoji;
                    emojiElement.style.position = 'absolute';
                    emojiElement.style.top = '10px';
                    emojiElement.style.right = '10px';
                    emojiElement.style.fontSize = '1.5rem';
                    emojiElement.style.animation = 'bounce 2s infinite';
                    emojiElement.classList.add('hover-emoji');
                    
                    // Hapus emoji sebelumnya jika ada
                    const oldEmoji = this.querySelector('.hover-emoji');
                    if (oldEmoji) oldEmoji.remove();
                    
                    this.appendChild(emojiElement);
                });
            });
        });
    </script>
</x-app-layout>