<div class="sidebar-sticky">
  <ul class="nav flex-column">
    <li class="nav-item">
      <a class="nav-link active" href="#">
        <span data-feather="home"></span>
        Dashboard <span class="sr-only">(current)</span>
      </a>
    </li>
  </ul>
  <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
    <span>Individual View</span>
    <a class="d-flex align-items-center text-muted" href="#">
      <span data-feather="plus-circle"></span>
    </a>
  </h6>
  <ul class="nav flex-column mb-2">
    @for ($i = 1; $i < 5; $i++)
        <li class="nav-item">
            <a class="nav-link" href="#">
                <span data-feather="zoom-in"></span>Figure {{$i}}
            </a>
        </li>
    @endfor
  </ul>
</div>
