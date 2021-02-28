<nav aria-label="Page navigation example" style="{{ (($result['total_results'] ?? '') == 0) ? 'visibility:hidden': '' }}">
  <ul class="pagination justify-content-center">
    <li class="page-item {{ ($currentPageNumber <= 1) ? 'disabled' : '' }}">
      <a class="page-link" href="{{ route($currentPageName,$currentPageNumber-(($currentPageName == 'search') ? 1 : 3)) }}{{ ($currentPageName == 'search') ? '?query='.urlencode($query) : '' }}" tabindex="-1" >
        Anterior
      </a>
    </li>
    <li class="page-item {{ ($currentPageNumber >= $total_pages) ? 'disabled' : '' }}">
      <a class="page-link" href="{{ route($currentPageName,$currentPageNumber+1) }}{{ ($currentPageName == 'search') ? '?query='.urlencode($query) : '' }}">
        Próxima
      </a>
    </li>
  </ul>
</nav>