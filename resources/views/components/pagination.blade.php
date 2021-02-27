<nav aria-label="Page navigation example" style="">
    <ul class="pagination justify-content-center">
      <li class="page-item ">
        <a class="page-link" href="{{ route('index',$page-1) ?? '' }}" tabindex="-1" >Anterior</a>
      </li>
      <li class="page-item"><a class="page-link" href="{{ route('index', 1) }}">{{ 1 }}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('index', 3) }}">{{ 2 }}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('index', 5) }}">{{ 3 }}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('index', 7) }}">{{ 4 }}</a></li>
      <li class="page-item">
        <a class="page-link" href="{{ route('index',$page+1) ?? '' }}">Próxima</a>
      </li>
    </ul>
  </nav>