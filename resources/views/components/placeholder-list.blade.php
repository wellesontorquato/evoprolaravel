@props(['placeholders', 'targetTextareaId'])

<div class="d-flex flex-wrap gap-3 mt-2">
    @foreach ($placeholders as $chave => $descricao)
        @php $placeholderText = '{{' . $chave . '}}'; @endphp
        <div class="d-flex flex-column align-items-start me-3 mb-2">
            <button type="button"
                class="btn btn-sm btn-outline-dark"
                data-placeholder=" {{ $placeholderText }} "
                onclick="inserirPlaceholder('{{ $targetTextareaId }}', this.dataset.placeholder)"
                title="{{ $descricao }}">
                {{ $placeholderText }}
            </button>
            <small class="text-muted mt-1">{{ $descricao }}</small>
        </div>
    @endforeach
</div>
