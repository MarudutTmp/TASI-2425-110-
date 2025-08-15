<x-app-layout>
    {{-- style form file dengan animasi --}}
    <style>
        * {
            font-family: 'Comic Sans MS', 'Arial Rounded MT Bold', Arial, sans-serif;
            box-sizing: border-box;
        }

        .upload-container {
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            width: 350px;
            margin: 50px auto;
            transition: all 0.3s ease;
            background: #f8f9ff;
            box-shadow: 0 4px 15px rgba(78, 115, 223, 0.2);
        }

        .upload-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(78, 115, 223, 0.3);
        }

        .upload-icon {
            font-size: 50px;
            color: #4A90E2;
            animation: bounce 2s infinite;
        }

        .upload-text {
            color: #777;
            margin: 10px 0;
            font-size: 18px;
        }

        .upload-btn {
            display: inline-block;
            padding: 12px 25px;
            font-size: 18px;
            background-color: #4E73DF;
            color: #fff;
            border: none;
            border-radius: 40px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 0 #3a5bbf;
            position: relative;
            overflow: hidden;
        }

        .upload-btn:hover {
            background-color: #357ABD;
            transform: translateY(2px);
            box-shadow: 0 2px 0 #3a5bbf;
        }

        .upload-btn:active {
            transform: translateY(4px);
            box-shadow: none;
        }

        .upload-btn::after {
            content: "📁";
            position: absolute;
            right: -20px;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .upload-btn:hover::after {
            right: 15px;
            opacity: 1;
        }

        .file-input {
            display: none;
        }

        .format-text {
            color: #777;
            font-size: 18px;
            margin-top: 10px;
        }

        /* Animasi bounce untuk emoji */
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
            40% {transform: translateY(-20px);}
            60% {transform: translateY(-10px);}
        }

        /* Animasi floating untuk kartu soal */
        .question-card {
            animation: float 6s ease-in-out infinite;
            transition: all 0.3s ease;
        }

        .question-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        @keyframes float {
            0% {transform: translateY(0px);}
            50% {transform: translateY(-10px);}
            100% {transform: translateY(0px);}
        }

        /* Style untuk tombol generate */
        .generate-btn {
            background: linear-gradient(45deg, #4E73DF, #6c8eff);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(78, 115, 223, 0.4);
        }

        .generate-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 20px rgba(78, 115, 223, 0.6);
        }

        .generate-btn::before {
            content: "✨";
            position: absolute;
            left: -30px;
            top: 50%;
            transform: translateY(-50%);
            transition: all 0.3s ease;
        }

        .generate-btn:hover::before {
            left: 15px;
        }

        /* Style untuk modal */
        #quizModal {
            animation: modalEntry 0.4s ease-out;
        }

        @keyframes modalEntry {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Emoji untuk feedback */
        .feedback-emoji {
            font-size: 20px;
            margin-right: 5px;
            display: inline-block;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {transform: rotate(0deg);}
            to {transform: rotate(360deg);}
        }
    </style>

    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">⚠️ {{ session('error') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Close</title>
                <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
            </svg>
        </span>
    </div>
    @endif

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        🎉 {{ session('success') }}
    </div>
    @endif

    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">📚 Generate Question</h1>
            </div>

            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                <!-- Datepicker built with flatpickr -->
                <x-datepicker />
            </div>
        </div>

        {{-- loader component dengan animasi --}}
        <x-loader />

        <!-- Cards Form Generate Soal -->
        <form id="generateForm" action="{{ route('generate.quiz') }}" method="POST" enctype="multipart/form-data"
            class="grid grid-cols-2 gap-4">
            @csrf

            <div class="border border-dashed border-[2px] rounded-[5px] border-[#4E73DF] hover:border-solid transition-all duration-300">
                <div class="upload-container" id="drop-zone">
                    <div class="upload-icon">📄✨</div>
                    <p class="upload-text">Drag and Drop file here</p>
                    <p>🤔 Or</p>
                    <label for="file-input" class="upload-btn">Browse File</label>
                    <input type="file" name="pdf" id="file-input" class="file-input" accept="application/pdf">
                    <p class="format-text">📌 Formats: pdf only</p>
                    <p id="file-name-display" class="text-gray-700 mt-2"></p>
                </div>
            </div>

            <div class="flex flex-col justify-between p-[40px] bg-white rounded-lg shadow-md">
                <div class="mb-6">
                    <div class="text-[16px] font-bold">🔢 Total Questions</div>
                    <input type="number" name="total_questions" class="w-full h-[53px] rounded border-2 border-[#4E73DF] px-3 focus:ring-2 focus:ring-blue-200">
                </div>
                <div class="mb-6">
                    <div class="text-[16px] font-bold">📝 Questions Type</div>
                    <select name="question_type" id="" class="w-full h-[53px] rounded border-2 border-[#4E73DF] px-3 focus:ring-2 focus:ring-blue-200">
                        <option selected>📋 Select</option>
                        <option value="Multiple Choice">🔘 Multiple Choice</option>
                        <option value="Essay">✏️ Essay</option>
                        <option value="True False">✅❌ True False</option>
                    </select>
                </div>
                <button type="submit" class="p-[12px] bg-[#4E73DF] text-white rounded-[5px] mt-4 hover:bg-[#3a5bbf] transition-all flex items-center justify-center gap-2">
                    🚀 Generate Questions
                </button>
            </div>
        </form>
    </div>
    <hr>

    <form action="{{ route('save.quiz') }}" method="POST" id="quizForm" enctype="multipart/form-data">
        @csrf
        {{-- <input type="hidden" name="id_user" value="{{ auth()->user()->id }}"> --}}
        <input type="hidden" name="type_quiz" value="{{ session('question_type') }}">

        @if (isset($questions) && is_array($questions))
            @foreach ($questions as $qIndex => $question)
                <div class="bg-white rounded p-4 m-6 shadow-md question-card">
                    <div class="text-black font-bold flex items-center gap-2">
                        <span class="text-[#4E73DF]">❓ Question {{ $qIndex + 1 }}:</span>
                    </div>
                    <textarea name="questions[{{ $qIndex }}][question]" class="w-full p-2 border rounded mt-2 focus:ring-2 focus:ring-blue-200"> {{ $question['question'] ?? 'No question text' }} </textarea>
                    <div class="grid grid-cols-3 gap-2 mt-4">
                        <div class="col-span-2">
                            @if (session('question_type') == 'Multiple Choice')
                                <div class="text-black font-bold mt-2 flex items-center gap-2">
                                    <span>🔘 Options</span>
                                </div>
                                <div class="grid grid-cols-2 gap-4 mt-2">
                                    @if (isset($question['options']) && is_array($question['options']))
                                        @foreach ($question['options'] as $key => $option)
                                            <div class="flex items-center border border-[#4E73DF] rounded overflow-hidden">
                                                <div class="bg-[#4E73DF] w-[30px] h-full flex items-center justify-center text-white font-bold">
                                                    {{ $key }}
                                                </div>
                                                <input type="text"
                                                    name="questions[{{ $qIndex }}][options][{{ $key }}]"
                                                    value="{{ $option ?? '' }}" 
                                                    class="w-full m-0 border-none px-3 py-2 focus:ring-2 focus:ring-blue-200">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            @endif
                        </div>
                        <div class="grid grid-cols-3 gap-4 mt-4 timer col-span-1">
                            <div>
                                <label class="font-bold flex items-center gap-1">⏱️ Time Limit</label>
                                <input type="number" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-200"
                                    name="questions[{{ $qIndex }}][time_limit]" value="0">
                            </div>
                            <div>
                                <label class="font-bold flex items-center gap-1">⭐ Set Point</label>
                                <input type="number" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-200"
                                    name="questions[{{ $qIndex }}][point]" value="0">
                            </div>
                            <div>
                                <label class="font-bold flex items-center gap-1">📊 Quiz Level</label>
                                <select name="questions[{{ $qIndex }}][level]" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-200">
                                    <option value="easy" {{ isset($question['level']) && $question['level'] == 'easy' ? 'selected' : '' }}>
                                        😊 Easy</option>
                                    <option value="medium" {{ isset($question['level']) && $question['level'] == 'medium' ? 'selected' : '' }}>
                                        🤔 Medium</option>
                                    <option value="high" {{ isset($question['level']) && $question['level'] == 'high' ? 'selected' : '' }}>
                                        🧠 High</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="text-black font-bold flex items-center gap-1">🎯 Correct Answer:</label> <br>
                        @if (session('question_type') == 'Essay')
                            <input type="text" name="questions[{{ $qIndex }}][answer]"
                                value="{{ $question['answer'] ?? '' }}"
                                class="bg-[#28A745] w-full font-medium text-white border-none p-2 rounded mt-2 focus:ring-2 focus:ring-green-200">
                        @elseif (session('question_type') == 'True False')
                            <select name="questions[{{ $qIndex }}][answer]"
                                class="bg-[#28A745] w-[100px] font-medium text-white border-none p-2 rounded mt-2 focus:ring-2 focus:ring-green-200">
                                <option value="True"
                                    {{ isset($question['answer']) && $question['answer'] == 'True' ? 'selected' : '' }}>
                                    ✅ True</option>
                                <option value="False"
                                    {{ isset($question['answer']) && $question['answer'] == 'False' ? 'selected' : '' }}>
                                    ❌ False</option>
                            </select>
                        @else
                            <input type="text" name="questions[{{ $qIndex }}][answer]"
                                value="{{ $question['answer'] ?? '' }}"
                                class="bg-[#28A745] w-[50px] font-medium text-white border-none p-2 rounded mt-2 text-center focus:ring-2 focus:ring-green-200">
                        @endif
                    </div>

                    <div class="mt-4">
                        <label class="text-black font-bold flex items-center gap-1">💬 Feedback:</label>
                        <textarea name="questions[{{ $qIndex }}][feedback]" class="w-full p-2 border rounded mt-2 focus:ring-2 focus:ring-blue-200"> {{ $question['feedback'] ?? '' }}</textarea>
                    </div>
                    <div class="flex justify-end items-center mt-2">
                        <label for="select-{{ $qIndex }}" class="mr-2 flex items-center gap-1">
                            <span class="feedback-emoji">👆</span> Select Question
                        </label>
                        <input id="select-{{ $qIndex }}" type="checkbox"
                            name="questions[{{ $qIndex }}][select]" value="1" class="w-5 h-5">
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center text-[18px] font-bold mt-4 flex flex-col items-center">
                <span class="text-4xl mb-2">😕</span>
                No questions found.
            </p>
        @endif

        @if ($questions != null)
            <!-- Tombol Generate Quiz -->
            <div class="text-right p-4">
                <button type="button" id="openModal"
                    class="generate-btn p-3 rounded w-[300px] text-white font-medium text-lg flex items-center justify-center gap-2">
                    🎯 Generate Quiz
                </button>
            </div>
        @endif

        <!-- Modal Pop-up untuk Input Quiz -->
        <div id="quizModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white shadow-xl p-[40px] rounded-lg w-[380px] max-w-full mx-4 transform transition-all duration-300">
                <h2 class="text-2xl font-bold text-center mb-6 flex items-center justify-center gap-2">
                    <span class="text-[#4E73DF]">📝</span> Generate Quiz
                </h2>

                <div class="mb-4">
                    <label class="block mb-1 font-medium flex items-center gap-1">📛 Quiz Name</label>
                    <input type="text" name="nama_quiz" required 
                        class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-200">
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-medium flex items-center gap-1">🔢 Quiz Code</label>
                    <input type="text" name="code_quiz" required 
                        class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-200">
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-medium flex items-center gap-1">⏰ Quiz Start</label>
                    <input type="datetime-local" name="start_time" required 
                        class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-200">
                </div>

                <div class="mb-6">
                    <label class="block mb-1 font-medium flex items-center gap-1">🏁 Quiz End</label>
                    <input type="datetime-local" name="end_time" required 
                        class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-200">
                </div>

                <div class="grid grid-cols-2 gap-4 mt-6">
                    <button type="button" id="closeModal"
                        class="px-6 py-3 bg-gray-400 text-white rounded hover:bg-gray-500 transition-all flex items-center justify-center gap-2">
                        ❌ Cancel
                    </button>
                    <button type="submit" class="px-6 py-3 bg-[#4E73DF] text-white rounded hover:bg-[#3a5bbf] transition-all flex items-center justify-center gap-2">
                        💾 Save Quiz
                    </button>
                </div>
            </div>
        </div>
    </form>

    <script>
        document.getElementById('openModal').addEventListener('click', function() {
            document.getElementById('quizModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent scrolling when modal is open
        });

        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('quizModal').classList.add('hidden');
            document.body.style.overflow = ''; // Re-enable scrolling
        });

        // Close modal when clicking outside
        document.getElementById('quizModal').addEventListener('click', function(e) {
            if (e.target === this) {
                document.getElementById('quizModal').classList.add('hidden');
                document.body.style.overflow = '';
            }
        });
    </script>

    {{-- script untuk loader --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const generateForm = document.getElementById('generateForm');
            const loader = document.getElementById('loader');

            generateForm.addEventListener('submit', function() {
                // Tampilkan loader saat form di-submit
                loader.classList.remove('hidden');
            });
        });
    </script>

    {{-- script untuk control file pdf --}}
    <script>
        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('file-input');
        const fileNameDisplay = document.getElementById('file-name-display');

        // Saat drag di atas drop zone
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.style.borderColor = "#357ABD";
            dropZone.style.backgroundColor = "#f0f5ff";
        });

        // Saat drag keluar dari drop zone
        dropZone.addEventListener('dragleave', () => {
            dropZone.style.borderColor = "#4A90E2";
            dropZone.style.backgroundColor = "#f8f9ff";
        });

        // Saat file di-drop ke drop zone
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.style.borderColor = "#4A90E2";
            dropZone.style.backgroundColor = "#f8f9ff";
            const files = e.dataTransfer.files;
            if (files.length > 0 && files[0].type === "application/pdf") {
                fileNameDisplay.textContent = "📄 File uploaded: " + files[0].name;
                fileNameDisplay.style.color = "#28A745";
                fileInput.files = files;
                
                // Animasi konfirmasi
                fileNameDisplay.style.transform = "scale(1.1)";
                setTimeout(() => {
                    fileNameDisplay.style.transform = "scale(1)";
                }, 300);
            } else {
                fileNameDisplay.textContent = "❌ Only PDF files are allowed!";
                fileNameDisplay.style.color = "#DC3545";
            }
        });

        // select file dari btn
        fileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file && file.type === "application/pdf") {
                fileNameDisplay.textContent = "📄 File uploaded: " + file.name;
                fileNameDisplay.style.color = "#28A745";
                
                // Animasi konfirmasi
                fileNameDisplay.style.transform = "scale(1.1)";
                setTimeout(() => {
                    fileNameDisplay.style.transform = "scale(1)";
                }, 300);
            } else {
                fileNameDisplay.textContent = "❌ Only PDF files are allowed!";
                fileNameDisplay.style.color = "#DC3545";
            }
        });

        // Animasi hover untuk kartu soal
        const questionCards = document.querySelectorAll('.question-card');
        questionCards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = "translateY(-5px)";
                card.style.boxShadow = "0 10px 25px rgba(0,0,0,0.1)";
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.transform = "";
                card.style.boxShadow = "";
            });
        });
    </script>
</x-app-layout>