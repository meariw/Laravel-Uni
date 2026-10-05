@if ($paginator->hasPages())
    <nav class="app-pagination" aria-label="Pagination">
        @if ($paginator->onFirstPage())
            <span class="page-link disabled">&laquo; Назад</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="page-link">&laquo; Назад</a>
        @endif
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="page-link">Вперёд &raquo;</a>
        @else
            <span class="page-link disabled">Вперёд &raquo;</span>
        @endif
    </nav>
@endif