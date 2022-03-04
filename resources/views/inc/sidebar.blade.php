<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
    <li class="{{ \Request::route()->getName() == 'admin.home' ? 'active' : '' }} nav-item"><a href="{{ route('admin.home') }}"><i class="feather icon-home"></i><span class="menu-title">Dashboard</span></a></li>

    <li class="{{ in_array(\Request::route()->getName(), [
        'admin.users.index',
        'admin.users.create',
        'admin.users.edit',
    ]) ? 'active' : '' }} nav-item"><a href="{{ route('admin.users.index') }}"><i class="feather icon-users"></i><span class="menu-title">Admin</span></a></li>
    
    <li class="{{ in_array(\Request::route()->getName(), [
        'admin.about.index',
    ]) ? 'active' : '' }} nav-item"><a href="{{ route('admin.about.index') }}"><i class="feather icon-alert-circle"></i><span class="menu-title">About</span></a></li>

    <li class="{{ in_array(\Request::route()->getName(), [
        'admin.people.index',
        'admin.people.create',
        'admin.people.edit',
    ]) ? 'active' : '' }} nav-item"><a href="{{ route('admin.people.index') }}"><i class="fa fa-users"></i><span class="menu-title">People</span></a></li>

    <li class="{{ in_array(\Request::route()->getName(), [
        'admin.work.index',
        'admin.work.create',
        'admin.work.edit',
    ]) ? 'active' : '' }} nav-item"><a href="{{ route('admin.work.index') }}"><i class="feather icon-briefcase"></i><span class="menu-title">Works</span></a></li>

    <li class="{{ in_array(\Request::route()->getName(), [
        'admin.digest.index',
        'admin.digest.create',
        'admin.digest.edit',
    ]) ? 'active' : '' }} nav-item"><a href="{{ route('admin.digest.index') }}"><i class="feather icon-codepen"></i><span class="menu-title">Digest</span></a></li>

    <li class="{{ in_array(\Request::route()->getName(), [
        'admin.program.index',
        'admin.program.create',
        'admin.program.edit',
    ]) ? 'active' : '' }} nav-item"><a href="{{ route('admin.program.index') }}"><i class="fa fa-tasks"></i><span class="menu-title">Program</span></a></li>

    <li class="{{ in_array(\Request::route()->getName(), [
        'admin.business-unit.index',
        'admin.business-unit.create',
        'admin.business-unit.edit',
    ]) ? 'active' : '' }} nav-item"><a href="{{ route('admin.business-unit.index') }}"><i class="fa fa-building"></i><span class="menu-title">Business Unit</span></a></li>

    <li class="{{ in_array(\Request::route()->getName(), [
        'admin.client.index',
        'admin.client.create',
        'admin.client.edit',
    ]) ? 'active' : '' }} nav-item"><a href="{{ route('admin.client.index') }}"><i class="fa fa-handshake-o"></i><span class="menu-title">Client</span></a></li>

    <li class="nav-item has-sub {{ in_array(\Request::route()->getName(), [
            'admin.submission',
        ]) ? 'sidebar-group-active' : '' }}"><a href="#"><i class="fa fa-paper-plane"></i><span class="menu-title">Submission</span></a>
        <ul class="menu-content">
            @foreach (['subscribe', 'internship'] as $type)
                <li class="{{ in_array(\Request::route()->getName(), [
                    'admin.submisison',
                    ]) && request()->type == $type || Request::route()->getName() == 'admin.submisison.show' && $type == 'internship'  ? 'active' : '' }}"><a href="{{ route('admin.submisison', $type) }}"><i class="feather icon-circle"></i><span class="menu-item">{{ Str::ucfirst($type) }}</span></a>
                </li>
            @endforeach
        </ul>
    </li>

    <li class="{{ in_array(\Request::route()->getName(), [
        'admin.setting.index',
    ]) ? 'active' : '' }} nav-item"><a href="{{ route('admin.setting.index') }}"><i class="feather icon-settings"></i><span class="menu-title">Setting</span></a></li>
</ul>
