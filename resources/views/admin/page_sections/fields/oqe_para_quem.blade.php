@php
  $c=[]; if(($mode??null)==='edit'&&isset($data)) $c=(array)($data->content??[]);
  $v=fn($k,$d=null)=>old("content.$k",$c[$k]??($defaults[$k]??$d));
@endphp

<div class="border rounded p-2">
  <div class="fw-semibold mb-2">O-que-é • Para quem é?</div>

  <div class="mb-2">
    <label class="form-label">Título</label>
    <input name="content[title]" class="form-control" value="{{ $v('title') }}">
  </div>

  <div class="mb-2">
    <label class="form-label">Texto</label>
    <textarea name="content[text]" rows="5" class="form-control">{{ $v('text') }}</textarea>
    <small class="text-muted">Use ponto/quebra de linha para novos parágrafos.</small>
  </div>

  <div>
    <label class="form-label">Imagem/arte (URL)</label>
    <input name="content[art_image]" class="form-control" value="{{ $v('art_image') }}">
  </div>
</div>
