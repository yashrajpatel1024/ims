<div class="sidebar" data-color="orange" data-background-color="white">
    <div class="logo">
        <center>
            {{ __('I-M-S') }}
        </center>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="material-icons">dashboard</i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'invoices' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('invoices_list') }}">
                    <i class="material-icons">receipt_long</i>
                    <p>{{ __('Invoice') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'estimates' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('estimates_list') }}">
                    <i class="material-icons">class</i>
                    <p>{{ __('Estimate') }}</p>
                </a>
            </li>
           
            <li class="nav-item{{ $activePage == 'services' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('services') }}">
                    <i class="material-icons">settings</i>
                    <p>{{ __('Services') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'customers' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('customers_list') }}">
                    <i class="material-icons">manage_accounts</i>
                    <p>{{ __('Customers') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'payments' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('payments_list') }}">
                    <i class="material-icons">credit_card</i>
                    <p>{{ __('Payment') }}</p>
                </a>
            </li>
             <li class="nav-item {{ ($activePage == 'invoices_report' || $activePage == 'customers_report' || 
                $activePage == 'due_payments_report') ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#reports" aria-expanded="false">
                    <i class="material-icons">description</i>
                    <p>{{ __('Reports') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse show" id="reports">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'invoices_report' ? ' active' : '' }}" >
                            <a class="nav-link" href="{{ route('invoices_report') }}">
                            <span class="sidebar-mini"> IR </span>
                            <span class="sidebar-normal">{{ __('Invoice Report') }} </span>
                        </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'customers_report' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('customers_report') }}">
                            <span class="sidebar-mini"> CR </span>
                            <span class="sidebar-normal"> {{ __('Customer Report') }} </span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'payments_report' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('payments_report') }}">
                            <span class="sidebar-mini"> PR </span>
                            <span class="sidebar-normal"> {{ __('Payments Report') }} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item{{ $activePage == 'todo' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('todo_list') }}">
                    <i class="material-icons">task</i>
                    <p>{{ __('Todo') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'expance' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('expance_list') }}">
                    <i class="material-icons">account_balance_wallet</i>
                    <p>{{ __('Expances') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'user' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('user.index') }}">
                    <i class="material-icons">supervisor_account</i>
                    <p>{{ __('Users') }}</p>
                </a>
            </li>
            </a>
            </li>
        </ul>
    </div>
</div>