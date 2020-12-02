<div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar" class>
        <!-- <div class="custom-menu">
            <button type="button" id="sidebarCollapse" class="btn btn-primary">
      <i class="fa fa-bars"></i>
      <span class="sr-only">Toggle Menu</span>
    </button>
</div> -->
        <div class="p-4">
          <h1><a href="index.html" class="logo">Diploma Work</a></h1>
          {{-- <h1><a href="index.html" class="logo">Qazaq University</a></h1> --}}
    <ul class="list-unstyled components mb-5">
        @foreach ($items as $item)
        {{-- <?php dd($item); ?> --}}
            <li>
                <a href="{{$item->url}}">{{ $item->title }} </a>
            </li>
        @endforeach

      {{-- <li class="active">
        <a href="#"><span class="fa fa-home mr-3"></span> Home</a>
      </li>
      <li>
          <a href="#"><span class="fa fa-user mr-3"></span> About</a>
      </li>
      <li>
      <a href="#"><span class="fa fa-briefcase mr-3"></span> Portfolio</a>
      </li>
      <li>
      <a href="#"><span class="fa fa-sticky-note mr-3"></span> Blog</a>
      </li>
      <li>
      <a href="#"><span class="fa fa-paper-plane mr-3"></span> Contact</a>
      </li> --}}

    </ul>

  </div>
</nav>

{{-- <script src="{{ asset('js/app.js') }}"></script> --}}
{{-- <script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/popper.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script> --}}
