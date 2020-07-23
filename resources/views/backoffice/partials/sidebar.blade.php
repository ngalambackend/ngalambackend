<aside id="sidebar-wrapper">
  <div class="sidebar-brand">
    <a href="">{{ env('APP_NAME') }}</a>
  </div>
  <div class="sidebar-brand sidebar-brand-sm">
    <a href="{{ route('backoffice.home') }}">{{ strtoupper(substr(env('APP_NAME'), 0, 2)) }}</a>
  </div>
  <ul class="sidebar-menu">
    <li class="menu-header">Dashboard</li>
    <li class="{{ setActive('backoffice.home') }}"><a class="nav-link" href="{{ route('backoffice.home') }}"><i class="fas fa-fire-alt"></i> <span>Dashboard</span></a></li>
    <li class="menu-header">Menus</li>
    <li class="{{ setActive('backoffice.setting.admin.*') }}"><a class="nav-link" href="{{ route('backoffice.setting.admin.index') }}"><i class="fas fa-users"></i> <span>Admins</span></a></li>
    <li class="{{ setActive('backoffice.setting.skill.*') }}">
      <a class="nav-link" href="{{ route('backoffice.setting.skill.index') }}">
        <i class="fas fa-users"></i> <span>Skills</span>
      </a>
    </li>
  </ul>
</aside>
