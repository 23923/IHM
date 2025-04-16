<!doctype html>
<html lang="en">
<head>
    <!-- Meta tags et CSS comme avant -->
    <title>Quiz: {{ $quiz->title }}</title>
    
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
                            <p>{{ $formation->titre }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="alert alert-info">
                    <h4 class="alert-heading">Instructions</h4>
                    <p>Ce quiz contient {{ count($quiz->questions) }} questions basées sur la formation "{{ $formation->titre }}".</p>
                    <hr>
                    <p class="mb-0">Score minimum requis: {{ $quiz->passing_score }}%</p>
                </div>

                <form action="{{ route('quiz.submit', ['id' => $quiz->id]) }}" method="POST" id="quizForm">
                @csrf
                    
                    @foreach($quiz->questions as $index => $question)
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            Question #{{ $index+1 }} ({{ $question['points'] ?? 1 }} point(s))
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $question['question'] }}</h5>
                            
                            @if($question['type'] === 'multiple')
                                @foreach($question['options'] as $optIndex => $option)
                                <div class="form-check my-2">
                                    <input class="form-check-input" type="radio" 
                                           name="answers[{{ $index }}]" 
                                           id="q{{ $index }}_opt{{ $optIndex }}" 
                                           value="{{ $optIndex }}"
                                           required>
                                    <label class="form-check-label" for="q{{ $index }}_opt{{ $optIndex }}">
                                        {{ $option['text'] }}
                                    </label>
                                </div>
                                @endforeach
                            @elseif($question['type'] === 'true_false')
                                <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                                    <label class="btn btn-outline-success">
                                        <input type="radio" name="answers[{{ $index }}]" value="1" required> Vrai
                                    </label>
                                    <label class="btn btn-outline-danger">
                                        <input type="radio" name="answers[{{ $index }}]" value="0"> Faux
                                    </label>
                                </div>
                            @else
                                <div class="form-group">
                                    <input type="text" class="form-control" 
                                           name="answers[{{ $index }}]" 
                                           placeholder="Votre réponse..."
                                           required>
                                </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                    
                    <div class="text-center my-4">
                     


                   


                    <div class="text-center my-4">
        <button type="submit" class="btn btn-primary btn-lg px-5">
            <i class="fas fa-paper-plane mr-2"></i> Soumettre le quiz
        </button>
    </div>
  

                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('importation.footer')

    <!-- JavaScript -->
    <script>
    document.getElementById('quizForm').addEventListener('submit', function(e) {
        const totalQuestions = parseInt("{{ count($quiz->questions) }}");
        let allAnswered = true;

        for (let i = 0; i < totalQuestions; i++) {
            const inputs = document.getElementsByName('answers[' + i + ']');
            let answered = false;

            for (let input of inputs) {
                if ((input.type === 'radio' || input.type === 'checkbox') && input.checked) {
                    answered = true;
                    break;
                }
                if (input.type === 'text' && input.value.trim() !== '') {
                    answered = true;
                    break;
                }
            }

            if (!answered) {
                allAnswered = false;
                // On guide visuellement l'utilisateur vers la question manquante
                inputs[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
                inputs[0].focus();
                break;
            }
        }

        if (!allAnswered) {
            e.preventDefault();
            alert('Veuillez répondre à toutes les questions avant de soumettre.');
        }
    });
</script>

</body>
</html>