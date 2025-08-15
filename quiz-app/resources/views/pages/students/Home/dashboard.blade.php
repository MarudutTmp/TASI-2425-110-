<x-student-layout>
    <style>
        /* Animasi Premium */
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            25% { transform: translateY(-15px) rotate(2deg); }
            50% { transform: translateY(-5px) rotate(-2deg); }
            75% { transform: translateY(-10px) rotate(1deg); }
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-20px); }
            60% { transform: translateY(-10px); }
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); box-shadow: 0 4px 15px rgba(61, 23, 174, 0.2); }
            50% { transform: scale(1.05); box-shadow: 0 8px 25px rgba(61, 23, 174, 0.3); }
        }
        
        @keyframes rainbow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        @keyframes confetti {
            0% { transform: translateY(0) rotate(0deg); opacity: 1; }
            100% { transform: translateY(-100px) rotate(360deg); opacity: 0; }
        }
        
        @keyframes glow {
            0%, 100% { text-shadow: 0 0 5px rgba(61, 23, 174, 0.5); }
            50% { text-shadow: 0 0 20px rgba(61, 23, 174, 0.8); }
        }
        
        /* Animasi Kartu Quiz */
        .quiz-card-animate {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        }
        
        .quiz-card-animate:hover {
            transform: translateY(-15px) scale(1.03);
            box-shadow: 0 20px 40px rgba(61, 23, 174, 0.25);
            z-index: 10;
        }
        
        .quiz-card-animate::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #3D17AE, #7C3AED, #A855F7, #D946EF, #F59E0B);
            background-size: 300% 100%;
            animation: rainbow 6s ease infinite;
        }
        
        /* Animasi Join Container */
        .join-container-animate {
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }
        
        .join-container-animate:hover {
            transform: scale(1.02);
            box-shadow: 0 15px 30px rgba(61, 23, 174, 0.15);
        }
        
        .join-container-animate::before {
            content: "✏️";
            position: absolute;
            font-size: 2rem;
            opacity: 0.1;
            right: 30px;
            top: 20px;
            animation: float 4s ease infinite;
        }
        
        /* Animasi Tombol Join */
        .join-btn-animate {
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }
        
        .join-btn-animate:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 20px rgba(61, 23, 174, 0.4);
        }
        
        .join-btn-animate::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: all 0.5s ease;
        }
        
        .join-btn-animate:hover::before {
            left: 100%;
        }
        
        /* Animasi Profil Card */
        .profile-card-animate {
            animation: pulse 4s infinite;
            background-size: 200% 200%;
            animation: rainbow 8s ease infinite, pulse 4s ease infinite;
            position: relative;
            overflow: hidden;
        }
        
        .profile-card-animate::after {
            content: "🎓";
            position: absolute;
            font-size: 5rem;
            opacity: 0.1;
            right: 20px;
            bottom: -20px;
            animation: float 6s ease infinite;
        }
        
        /* Animasi Tombol Aksi */
        .action-btn-animate {
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }
        
        .action-btn-animate:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(61, 23, 174, 0.3);
        }
        
        .action-btn-animate img {
            transition: all 0.4s ease;
        }
        
        .action-btn-animate:hover img {
            transform: scale(1.3) rotate(10deg);
            animation: bounce 0.6s ease;
        }
        
        /* Animasi Masuk */
        @keyframes cardEntrance {
            from { 
                opacity: 0;
                transform: translateY(50px) scale(0.8);
                filter: blur(5px);
            }
            to { 
                opacity: 1;
                transform: translateY(0) scale(1);
                filter: blur(0);
            }
        }
        
        .grid-animation {
            animation: cardEntrance 0.8s ease-out forwards;
            opacity: 0;
        }
        
        /* Background animasi */
        .bg-animate {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: -1;
            background: linear-gradient(-45deg, #f3f4f6, #e5e7eb, #f9fafb, #f3f4f6);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
        }
        
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>

    <!-- Background animasi -->
    <div class="bg-animate"></div>

    <div class="">
        <div class="ml-[100px] mr-[100px] relative z-10">
            <div class="grid grid-cols-2 gap-4 mt-[60px]">
                <div class="join-container-animate border shadow flex justify-center items-center rounded-[10px] p-[50px]">
                    <form action="{{ route('quiz.join') }}" method="POST" class="flex w-full relative z-10">
                        @csrf
                        <div class="bg-white shadow flex items-center w-full p-2 rounded-[10px]">
                            <input type="text" 
                                   name="code_quiz" 
                                   placeholder="Enter quiz code"
                                   class="border-none w-3/4 h-[50px] text-[18px] rounded px-2 focus:ring-2 focus:ring-indigo-300" 
                                   required>
                            <button type="submit" 
                                    class="join-btn-animate ml-1 bg-[#3D17AE] text-white w-1/4 h-[50px] rounded-[10px] shadow hover:bg-[#2E1199] transition-colors duration-300 flex items-center justify-center relative overflow-hidden group">
                                <span class="mr-1 relative z-10">Join</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 relative z-10" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                                <!-- Button shine effect -->
                                <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="profile-card-animate bg-gradient-to-br from-white to-purple-700 border shadow p-[30px] rounded-[10px]">
                    <div class="grid grid-cols-2 gap-2">
                        <div class="text-[18px] font-bold">Hello, Marudut</div>
                        <div class="flex justify-end">
                            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 font-bold text-xl">
                                M
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-4 gap-6 mt-[70px]">
                @foreach ($quizData as $index => $quiz)
                    <div class="quiz-card-animate grid-animation border bg-white shadow rounded-lg text-[12px] text-[#808080] text-center p-[25px]" style="animation-delay: {{ $index * 0.1 }}s">
                        <h2 class="text-[18px] text-black font-semibold">{{ $quiz['nama_quiz'] }}</h2>
                        <p class="m-4">Total Questions: {{ $quiz['total_questions'] }}</p>
                        <p>Total Contribution: {{ $quiz['total_contribution'] }}</p>

                        <div class="grid grid-cols-2 gap-2">
                            <a href="{{ route('quiz.questions', $quiz['id']) }}" class="action-btn-animate bg-[#3D17AE] text-white p-2 text-center cursor-pointer rounded mt-4 w-full flex items-center">
                                <img width="15" height="15" class="mr-2" src="{{asset('images/eye.png')}}" alt=""/>Questions
                            </a>
                            <a href="{{ route('quiz.leaderboard', $quiz['id']) }}" class="action-btn-animate bg-[#3D17AE] text-white p-2 text-center cursor-pointer rounded mt-4 w-full flex items-center">
                                <img width="15" height="15" class="mr-2" src="{{asset('images/eye.png')}}" alt=""/>Leaderboard
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animasi untuk tombol join
            const joinBtn = document.querySelector('.join-btn-animate');
            if (joinBtn) {
                joinBtn.addEventListener('mouseenter', function() {
                    this.querySelector('span').textContent = 'Join Quiz';
                });
                
                joinBtn.addEventListener('mouseleave', function() {
                    this.querySelector('span').textContent = 'Join';
                });
            }
            
            // Efek hover pada kartu quiz
            const quizCards = document.querySelectorAll('.quiz-card-animate');
            quizCards.forEach((card, index) => {
                card.addEventListener('mouseenter', function() {
                    const emojis = ['📚', '🎓', '🧠', '✏️', '📝', '🔍', '🌟', '🎯', '🏆', '💡'];
                    const emoji = emojis[Math.floor(Math.random() * emojis.length)];
                    
                    const emojiElement = document.createElement('div');
                    emojiElement.textContent = emoji;
                    emojiElement.style.position = 'absolute';
                    emojiElement.style.top = '15px';
                    emojiElement.style.right = '15px';
                    emojiElement.style.fontSize = '1.8rem';
                    emojiElement.style.animation = 'float 3s ease infinite';
                    emojiElement.style.zIndex = '10';
                    emojiElement.classList.add('hover-emoji');
                    
                    const oldEmoji = this.querySelector('.hover-emoji');
                    if (oldEmoji) oldEmoji.remove();
                    
                    this.appendChild(emojiElement);
                });
            });

            // Form submission handling
            const joinForm = document.querySelector('form[action="{{ route('quiz.join') }}"]');
            if (joinForm) {
                joinForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const submitBtn = this.querySelector('button[type="submit"]');
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<span class="mr-1">Joining...</span><svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
                    
                    // Simulate API call (replace with actual fetch/AJAX)
                    setTimeout(() => {
                        this.submit();
                    }, 1000);
                });
            }
        });
    </script>
</x-student-layout>