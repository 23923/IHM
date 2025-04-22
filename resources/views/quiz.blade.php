<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Shool</title>
  <link rel="icon" href="{{ asset('img/logo.png') }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <style>
    :root {
      --primary-color: #4e73df;
      --secondary-color: #f8f9fc;
      --success-color: #1cc88a;
      --danger-color: #e74a3b;
      --warning-color: #f6c23e;
      --info-color: #36b9cc;
      --dark-color: #5a5c69;
      --light-color: #f8f9fc;
    }

    body {
      background-color: var(--light-color);
      font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
      line-height: 1.6;
    }

    /* Header & Breadcrumb */
    .breadcrumb_iner {
      background-size: cover;
      background-position: center;
      padding: 80px 0;
      position: relative;
      background-color: var(--dark-color);
    }

    .breadcrumb_iner::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0, 0, 0, 0.4);
    }

    .breadcrumb_iner_item {
      position: relative;
      z-index: 1;
      color: white;
    }

    .breadcrumb_iner_item h2 {
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
    }

    /* Quiz Container */
    .quiz-container {
      background: white;
      border-radius: 0.5rem;
      box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
      padding: 2rem;
      margin-bottom: 3rem;
      position: relative;
    }

    .quiz-header {
      text-align: center;
      margin-bottom: 2rem;
      padding-bottom: 1rem;
      border-bottom: 1px solid #e3e6f0;
    }

    .quiz-title {
      color: var(--primary-color);
      font-weight: 700;
      font-size: 2rem;
    }

    /* Questions */
    .question-card {
      border: none;
      border-left: 0.25rem solid var(--primary-color);
      border-radius: 0.35rem;
      margin-bottom: 1.5rem;
      box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
      transition: all 0.3s ease;
      opacity: 0;
      animation: fadeIn 0.5s ease forwards;
      position: relative;
    }

    .question-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 0.5rem 1.5rem 0 rgba(58, 59, 69, 0.2);
    }

    .question-header {
      background-color: var(--secondary-color);
      border-bottom: 1px solid #e3e6f0;
      font-weight: 600;
      color: var(--primary-color);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .question-body {
      padding: 1.5rem;
    }

    .question-title {
      font-weight: 600;
      margin-bottom: 1.2rem;
      font-size: 1.2rem;
    }

    /* Options */
    .option-label {
      display: block;
      padding: 0.75rem 1.25rem;
      margin-bottom: 0.5rem;
      border-radius: 0.35rem;
      cursor: pointer;
      transition: all 0.2s;
      border: 1px solid #d1d3e2;
      position: relative;
    }

    .option-label:hover {
      background-color: #f8f9fa;
      border-color: var(--primary-color);
    }

    .option-input:checked + .option-label {
      border-color: var(--primary-color);
      background-color: rgba(78, 115, 223, 0.1);
      color: var(--primary-color);
      font-weight: 600;
    }

    /* Radio Icons */
    .option-input + .option-label .fa-circle { display: inline-block; }
    .option-input + .option-label .fa-check-circle { display: none; }
    .option-input:checked + .option-label .fa-circle { display: none; }
    .option-input:checked + .option-label .fa-check-circle { 
      display: inline-block; 
      color: var(--primary-color); 
    }

    /* True/False Buttons */
    .true-false-container {
      display: flex;
      gap: 1rem;
    }

    .true-false-btn {
      flex: 1;
    }

    .true-false-btn .btn {
      width: 100%;
      padding: 0.75rem;
      font-weight: 600;
    }

    .btn-check { 
      position: absolute;
      opacity: 0;
      width: 0;
      height: 0;
    }

    /* Progress & Navigation */
    .progress-container {
      position: sticky;
      top: 80px;
      margin-bottom: 2rem;
    }

    .progress {
      height: 0.75rem;
      border-radius: 0.25rem;
      background-color: #e9ecef;
    }

    .progress-bar {
      height: 100%;
      border-radius: 0.25rem;
      transition: width 0.6s ease;
    }

    /* Navigation Buttons */
    .question-nav-btn {
      transition: all 0.2s ease;
      width: 35px;
      height: 35px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 600;
      position: relative;
      margin: 0.25rem;
    }

    /* Button States */
    .question-nav-btn.btn-outline-primary {
      color: var(--primary-color);
      border-color: var(--primary-color);
      background-color: transparent;
    }

    .question-nav-btn.btn-outline-primary:hover {
      background-color: rgba(78, 115, 223, 0.1);
    }

    .question-nav-btn.visited {
      background-color: rgba(78, 115, 223, 0.1);
      font-weight: normal;
    }

    .question-nav-btn.visited::after {
      content: '';
      position: absolute;
      bottom: 3px;
      left: 50%;
      transform: translateX(-50%);
      width: 60%;
      height: 2px;
      background-color: var(--primary-color);
      border-radius: 1px;
    }

    .question-nav-btn.btn-primary {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
      color: white;
    }

    .question-nav-btn.btn-info {
      background-color: var(--info-color);
      border-color: var(--info-color);
      color: white;
      box-shadow: 0 0 0 0.2rem rgba(54, 185, 204, 0.5);
      z-index: 2;
    }

    /* Timer */
    .quiz-timer {
      position: absolute;
      top: 1rem;
      right: 1rem;
      background-color: var(--dark-color);
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 0.25rem;
      font-weight: bold;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .quiz-container {
        padding: 1rem;
        margin-left: -15px;
        margin-right: -15px;
        border-radius: 0;
      }

      .breadcrumb_iner_item h2 {
        font-size: 1.8rem;
      }

      .progress-container {
        position: static;
      }

      .true-false-container {
        flex-direction: column;
        gap: 0.5rem;
      }

      .quiz-timer {
        position: relative;
        top: auto;
        right: auto;
        margin-bottom: 1rem;
        display: inline-block;
      }
    }

    /* Animations */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.05); }
      100% { transform: scale(1); }
    }

    .pulse {
      animation: pulse 1.5s infinite;
    }
  </style>
</head>
<body>
@include('importation.header')
<section class="breadcrumb breadcrumb_bg">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="breadcrumb_iner text-center">
          <div class="breadcrumb_iner_item">
            <h2>Évaluation de la formation</h2>
            <p>{{ $quiz->title }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="container my-5">
  <div class="row">
    <!-- Sidebar - Progress & Navigation -->
    <div class="col-lg-3">
      <div class="progress-container">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Progression</h6>
          </div>
          <div class="card-body">
            <div class="progress mb-3">
              <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" 
                   role="progressbar" style="width: 0%" 
                   aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="progressBar"></div>
            </div>
            <p class="text-center mb-1"><strong id="answeredCount">0</strong> / {{ count($quiz->questions) }} questions répondues</p>
            <p class="text-center small text-muted mb-0">Score minimum: {{ $quiz->passing_score }}%</p>
          </div>
        </div>

        <div class="card shadow">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Navigation</h6>
          </div>
          <div class="card-body p-2">
            <div class="d-flex flex-wrap justify-content-center" id="questionNav">
              @foreach($quiz->questions as $index => $question)
                <a href="#question-{{ $index+1 }}" class="btn btn-sm btn-outline-primary m-1 question-nav-btn"
                   data-question="{{ $index+1 }}">{{ $index+1 }}</a>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Quiz Content -->
    <div class="col-lg-9">
      <div class="quiz-container shadow-sm" role="main" aria-labelledby="quizTitle">
        <!-- Timer -->
        <div class="quiz-timer" id="quizTimer">
          <i class="fas fa-clock mr-2"></i>
          <span id="timeDisplay">30:00</span>
        </div>

        <div class="quiz-header">
          <h1 class="quiz-title" id="quizTitle"><i class="fas fa-graduation-cap mr-2" aria-hidden="true"></i> Quiz: {{ $formation->titre }}</h1>
          <p class="lead">Testez vos connaissances acquises pendant la formation</p>
        </div>

        <!-- Validation Alerts -->
        <div id="validationAlertPlaceholder"></div>

        <div class="alert alert-info alert-dismissible fade show" role="alert">
          <i class="fas fa-info-circle mr-2"></i>
          <strong>Instructions :</strong> Ce quiz contient {{ count($quiz->questions) }} questions. Vous devez obtenir au moins {{ $quiz->passing_score }}% pour réussir. Bonne chance !
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form action="{{ route('quiz.submit', ['id' => $quiz->id]) }}" method="POST" id="quizForm">
          @csrf

          @foreach($quiz->questions as $index => $question)
          <div class="card question-card mb-4" id="question-{{ $index+1 }}" 
               data-question-index="{{ $index }}" 
               role="group" 
               aria-labelledby="question-{{ $index+1 }}-header">
            <div class="card-header question-header" id="question-{{ $index+1 }}-header">
              <span>Question #{{ $index+1 }} <span class="badge badge-primary ml-2">{{ $question['points'] ?? 1 }} point(s)</span></span>
              <span class="badge badge-light text-uppercase">
                {{ $question['type'] === 'multiple' ? 'Choix multiple' : ($question['type'] === 'true_false' ? 'Vrai/Faux' : 'Réponse libre') }}
              </span>
            </div>
            <div class="card-body question-body">
              <h5 class="question-title">{{ $question['question'] }}</h5>

              @if($question['type'] === 'multiple')
                <div class="options-container" role="group" aria-labelledby="question-{{ $index+1 }}-options">
                  @foreach($question['options'] as $optIndex => $option)
                    <div class="form-group mb-2">
                      <input type="radio" class="option-input d-none"
                             name="answers[{{ $index }}]"
                             id="q{{ $index }}_opt{{ $optIndex }}"
                             value="{{ $optIndex }}"
                             aria-labelledby="q{{ $index }}_opt{{ $optIndex }}_label">
                      <label class="option-label" for="q{{ $index }}_opt{{ $optIndex }}" id="q{{ $index }}_opt{{ $optIndex }}_label">
                        <i class="far fa-circle mr-2" aria-hidden="true"></i>
                        <i class="fas fa-check-circle mr-2" aria-hidden="true"></i>
                        {{ $option['text'] }}
                      </label>
                    </div>
                  @endforeach
                </div>
              @elseif($question['type'] === 'true_false')
                <div class="true-false-container" role="group" aria-labelledby="question-{{ $index+1 }}-options">
                  <div class="true-false-btn">
                    <input type="radio" class="btn-check" name="answers[{{ $index }}]"
                           id="q{{ $index }}_true" value="1" autocomplete="off">
                    <label class="btn btn-outline-success w-100" for="q{{ $index }}_true">
                      <i class="fas fa-check mr-2"></i> Vrai
                    </label>
                  </div>
                  <div class="true-false-btn">
                    <input type="radio" class="btn-check" name="answers[{{ $index }}]"
                           id="q{{ $index }}_false" value="0" autocomplete="off">
                    <label class="btn btn-outline-danger w-100" for="q{{ $index }}_false">
                      <i class="fas fa-times mr-2"></i> Faux
                    </label>
                  </div>
                </div>
              @else
                <div class="form-group">
                  <textarea class="form-control" name="answers[{{ $index }}]"
                            rows="3" placeholder="Saisissez votre réponse ici..."
                            aria-labelledby="question-{{ $index+1 }}-textarea"></textarea>
                </div>
              @endif
            </div>
          </div>
          @endforeach

          <div class="text-center mt-5">
            <button type="submit" class="btn btn-primary btn-lg btn-submit px-5">
              <i class="fas fa-paper-plane mr-2"></i> Soumettre le quiz
            </button>
            <p class="text-muted mt-3">
              <small>Vous ne pourrez pas modifier vos réponses après soumission.</small>
            </p>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@include('importation.footer')

<script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/wow.js') }}"></script>
<script>
$(document).ready(function() {
    // Initialize animations
    if (typeof WOW === 'function') {
        new WOW().init();
    }

    // Quiz variables
    const quizForm = $('#quizForm');
    const totalQuestions = parseInt("{{ count($quiz->questions) }}", 10);
    const passingScore = parseInt("{{ $quiz->passing_score }}", 10);
    const progressBar = $('#progressBar');
    const answeredCountEl = $('#answeredCount');
    const currentQuestionEl = $('#currentQuestion');
    const questionNav = $('#questionNav');
    const navButtons = $('.question-nav-btn');
    const validationAlertPlaceholder = $('#validationAlertPlaceholder');
    const headerHeight = 80;
    const timeLimit = 30 * 60; // 30 minutes in seconds
    let timeLeft = timeLimit;
    let timerInterval;
    
    // Track questions state
    const answeredQuestions = new Set();
    const viewedQuestions = new Set();
    let currentVisibleQuestion = 1;

    // Timer functions
    function startTimer() {
        updateTimerDisplay();
        timerInterval = setInterval(function() {
            timeLeft--;
            updateTimerDisplay();
            
            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                timeUp();
            } else if (timeLeft <= 300) { // 5 minutes left
                $('#quizTimer').addClass('pulse');
            }
        }, 1000);
    }

    function updateTimerDisplay() {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        $('#timeDisplay').text(`${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`);
    }

    function timeUp() {
        $('#quizTimer').removeClass('pulse').addClass('bg-danger');
        $('#timeDisplay').text('Temps écoulé!');
        
        // Show alert
        const alertHtml = `
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <i class="fas fa-hourglass-end mr-2"></i>
                <strong>Temps écoulé!</strong> Votre quiz va être soumis automatiquement.
            </div>`;
        validationAlertPlaceholder.html(alertHtml);
        
        // Submit form after short delay
        setTimeout(() => {
            quizForm.submit();
        }, 3000);
    }

    // Progress tracking
    function updateProgress() {
        const answeredCount = answeredQuestions.size;
        const progress = totalQuestions > 0 ? Math.round((answeredCount / totalQuestions) * 100) : 0;

        progressBar.css('width', progress + '%')
                  .attr('aria-valuenow', progress);
        answeredCountEl.text(answeredCount);
        
        // Update navigation buttons
        navButtons.each(function() {
            const questionNum = parseInt($(this).data('question'), 10);
            const questionIndex = questionNum - 1;
            
            $(this).removeClass('visited btn-primary');
            
            if (answeredQuestions.has(questionIndex)) {
                $(this).addClass('btn-primary');
            } else if (viewedQuestions.has(questionIndex)) {
                $(this).addClass('visited');
            }
        });
    }

    // Question navigation
    function highlightCurrentQuestion(questionNum) {
        if (questionNum < 1 || questionNum > totalQuestions) return;
        
        currentVisibleQuestion = questionNum;
        currentQuestionEl.text(questionNum);
        
        // Track viewed questions
        viewedQuestions.add(questionNum - 1);
        
        // Update navigation buttons
        navButtons.removeClass('btn-info');
        const currentNavBtn = $(`.question-nav-btn[data-question="${questionNum}"]`);
        if (currentNavBtn.length) {
            currentNavBtn.addClass('btn-info');
        }
        
        updateProgress();
    }

    // Scroll handling with throttling
    let lastScrollPosition = 0;
    let scrollTimeout;
    
    function handleScroll() {
        const scrollPosition = $(window).scrollTop();
        
        // Only proceed if scrolled significantly
        if (Math.abs(scrollPosition - lastScrollPosition) > 50) {
            lastScrollPosition = scrollPosition;
            
            let foundQuestion = -1;
            const windowHeight = $(window).height();
            const viewTop = scrollPosition + headerHeight;
            const viewBottom = scrollPosition + windowHeight;
            
            // Find the most visible question
            for (let i = 1; i <= totalQuestions; i++) {
                const questionElement = $(`#question-${i}`);
                if (questionElement.length) {
                    const elementTop = questionElement.offset().top;
                    const elementBottom = elementTop + questionElement.outerHeight();
                    
                    // Check if question is in view
                    if ((elementTop >= viewTop && elementTop < viewBottom) ||
                        (elementBottom > viewTop && elementBottom <= viewBottom) ||
                        (elementTop <= viewTop && elementBottom >= viewBottom)) {
                        foundQuestion = i;
                        break;
                    }
                }
            }
            
            // Update current question if found and different
            if (foundQuestion !== -1 && foundQuestion !== currentVisibleQuestion) {
                highlightCurrentQuestion(foundQuestion);
            }
        }
    }
    
    // Event handlers
    $(window).on('scroll', function() {
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(handleScroll, 100);
    });

    // Answer change handler
    quizForm.on('change input', 'input[name^="answers"], textarea[name^="answers"]', function() {
        const questionCard = $(this).closest('.question-card');
        const questionIndex = parseInt(questionCard.data('question-index'), 10);
        
        if (!isNaN(questionIndex)) {
            answeredQuestions.add(questionIndex);
            updateProgress();
            highlightCurrentQuestion(questionIndex + 1);
        }
    });

    // Question focus handler
    quizForm.on('focus', 'input[name^="answers"], textarea[name^="answers"]', function() {
        const questionCard = $(this).closest('.question-card');
        const questionIndex = parseInt(questionCard.data('question-index'), 10);
        if (!isNaN(questionIndex)) {
            highlightCurrentQuestion(questionIndex + 1);
        }
    });

    // Navigation button click handler
    questionNav.on('click', '.question-nav-btn', function(e) {
        e.preventDefault();
        const questionNum = $(this).data('question');
        const targetElement = $(`#question-${questionNum}`);
        
        if (targetElement.length) {
            highlightCurrentQuestion(questionNum);
            
            $('html, body').animate({
                scrollTop: targetElement.offset().top - headerHeight
            }, 500);
        }
    });

    // Form submission handler
    quizForm.on('submit', function(e) {
        validationAlertPlaceholder.empty();
        
        // Check if all questions answered
        if (answeredQuestions.size < totalQuestions) {
            e.preventDefault();
            
            // Find first unanswered question
            let firstUnanswered = -1;
            for (let i = 0; i < totalQuestions; i++) {
                if (!answeredQuestions.has(i)) {
                    firstUnanswered = i + 1;
                    break;
                }
            }
            
            // Scroll to first unanswered question
            if (firstUnanswered !== -1) {
                const targetElement = $(`#question-${firstUnanswered}`);
                if (targetElement.length) {
                    $('html, body').animate({
                        scrollTop: targetElement.offset().top - headerHeight
                    }, 500, function() {
                        highlightCurrentQuestion(firstUnanswered);
                        targetElement.css('border-left-color', 'var(--danger-color)')
                                   .animate({opacity: 0.7}, 300)
                                   .animate({opacity: 1}, 300);
                        setTimeout(() => {
                            targetElement.css('border-left-color', 'var(--primary-color)');
                        }, 2000);
                    });
                }
            }
            
            // Show alert
            const alertHtml = `
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Veuillez répondre à toutes les ${totalQuestions} questions avant de soumettre.
                    ${firstUnanswered !== -1 ? `La question #${firstUnanswered} semble incomplète.` : ''}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>`;
            validationAlertPlaceholder.html(alertHtml);
        } else {
            // Disable submit button to prevent double submission
            $(this).find('.btn-submit')
                  .prop('disabled', true)
                  .html('<i class="fas fa-spinner fa-spin mr-2"></i> Soumission...');
        }
    });

    // Initialize
    updateProgress();
    highlightCurrentQuestion(1);
    startTimer();
});
</script>
</body>
</html>