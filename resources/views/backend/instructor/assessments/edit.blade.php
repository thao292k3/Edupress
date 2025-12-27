@extends('backend.instructor.master')

@section('content')
<div class="card">
    <div class="card-header"><h4>Edit Question</h4></div>
    <div class="card-body">
        <form method="post" action="{{ route('instructor.assessments.update', $q->id) }}">
            @csrf @method('PUT')
            <div class="form-group">
                <label>Question</label>
                <textarea name="question" class="form-control" required>{{ $q->question }}</textarea>
            </div>
            <div class="form-group">
                <label>Options (one per line)</label>
                @php
                    $lines = [];
                    foreach($q->options ?? [] as $opt) {
                        if (is_array($opt) || is_object($opt)) {
                            $t = $opt['text'] ?? ($opt->text ?? '');
                            $w = $opt['weight'] ?? ($opt->weight ?? 1);
                            $l = $opt['level'] ?? ($opt->level ?? '');
                            $lines[] = $t . '|' . $w . '|' . $l;
                        } else {
                            $lines[] = $opt;
                        }
                    }
                @endphp
                <textarea name="options_text" class="form-control">{{ implode("\n", $lines) }}</textarea>
            </div>
            <div class="form-group">
                <label>Correct option</label>
                <input type="text" name="correct_option" class="form-control" value="{{ $q->correct_option }}">
            </div>
            <button class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
