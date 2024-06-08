<div class="iq-sidebar">
  <div class="iq-sidebar-logo d-flex justify-content-between">
    <a href="index.html">
      <img src="images/logo-1.png.png" class="img-fluid" alt="">
      <span>JK</span>
    </a>
    <div class="iq-menu-bt align-self-center">
      <div class="wrapper-menu">
        <div class="line-menu half start"></div>
        <div class="line-menu"></div>
        <div class="line-menu half end"></div>
      </div>
    </div>
  </div>
  <div id="sidebar-scrollbar">
    <nav class="iq-sidebar-menu">
      <ul id="iq-sidebar-toggle" class="iq-menu">
        <li class="iq-menu-title"><i class="ri-separator"></i><span>Navigasi</span></li>
        <li Class="
        @if (request()->url() == route('dashboard'))
          active
        @endif
        ">
          <a href="{{route('dashboard')}}" class="iq-waves-effect"><i class="ri-home-4-line"></i><span>Dashboard</span></a>
        </li>

        <li class="
        @if (request()->url() == route('users.index'))
          active
        @endif
        ">
          <a href="{{route('users.index')}}" class="iq-waves-effect"><i class="ri-user-line"></i><span>Pengguna</span></a>
        </li>

        <li class="
        @if (request()->url() == route('LEDControllers.index'))
          active
        @endif
        ">
          <a href="{{route('LEDControllers.index')}}" class="iq-waves-effect"><i class="ri-lightbulb-line"></i><span>LED
              Control</span></a>
        </li>

        <li Class="
        @if (request()->url() == route('sensors.index'))
          active
        @endif
        ">
          <a href="{{route('sensors.index')}}" class="iq-waves-effect"><i class="ri-sensor-line"></i><span>Sensor</span></a>
        </li>
      </ul>
    </nav>
    <div class="p-3"></div>
  </div>
</div>