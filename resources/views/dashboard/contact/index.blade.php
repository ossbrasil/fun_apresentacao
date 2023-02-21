@extends('layouts.dashboard')
@section('title', 'Contatos')
@section('nav-contact-open', 'menu-open')
@section('nav-contatc-ul', 'active')
@section('nav-contact-li-show', 'active')
@section('content')

    <div class="modal fade" id="modal-success">
        <div class="modal-dialog">
            <div class="modal-content bg-success">
                <div class="modal-header">
                    <h4 class="modal-title">Sucesso!</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ session('success') }}</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <div class="content-wrapper">

        <!-- modals -->
        @if (session('success'))
            <button id="modal-success-click" type="button" class="btn btn-success" style="display: none"
                data-toggle="modal" data-target="#modal-success">
                Launch Success Modal
            </button>

            <script>
                $(document).ready(function() {
                    $("#modal-success-click").trigger('click');
                });
            </script>
        @endif

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Contatos</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Início</a></li>
                            <li class="breadcrumb-item active">Contatos</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <a href="{{ route('dashboard-contact-create') }}" class="btn btn-primary btn-block mb-3">Cadastrar</a>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Opções</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-star text-warning mr-2"></i>
                                        Não lidos
                                        <span class="badge bg-primary float-right">
                                            {{ count($contacts->where('is_read', 0)->get()) }}
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-star text-secondary mr-2"></i>
                                        Lidos
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Labels</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('dashboard-contact-label', ['label' => 'important']) }}"
                                        class="nav-link">
                                        <i class="far fa-circle text-warning"></i>
                                        Importante
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('dashboard-contact-label', ['label' => 'offers']) }}"
                                        class="nav-link">
                                        <i class="far fa-circle text-light"></i>
                                        Propostas
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('dashboard-contact-label', ['label' => 'compliment']) }}"
                                        class="nav-link">
                                        <i class="far fa-circle text-success"></i>
                                        Elogios
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('dashboard-contact-label', ['label' => 'complaint']) }}"
                                        class="nav-link">
                                        <i class="far fa-circle text-danger"></i>
                                        Reclamações
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('dashboard-contact-label', ['label' => 'suggestion']) }}"
                                        class="nav-link">
                                        <i class="far fa-circle text-primary"></i>
                                        Sugestões
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('dashboard-contact-label', ['label' => 'others']) }}"
                                        class="nav-link">
                                        <i class="far fa-circle text-secondary"></i>
                                        Outros
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Inbox</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" placeholder="Search Mail">
                                    <div class="input-group-append">
                                        <div class="btn btn-primary">
                                            <i class="fas fa-search"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="mailbox-controls">
                                <!-- Check all button -->
                                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i
                                        class="far fa-square"></i>
                                </button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </div>
                                <!-- /.btn-group -->
                                <button type="button" class="btn btn-default btn-sm">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                                <div class="float-right">
                                    1-50/200
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-sm">
                                            <i class="fas fa-chevron-left"></i>
                                        </button>
                                        <button type="button" class="btn btn-default btn-sm">
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
                                    </div>
                                    <!-- /.btn-group -->
                                </div>
                                <!-- /.float-right -->
                            </div>
                            <div class="table-responsive mailbox-messages">
                                <table class="table table-hover table-striped">
                                    <tbody>
                                        @foreach ($contacts->orderBy('id', 'desc')->get()->all() as $contact)
                                            <tr>
                                                <td>
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" class="checkbox-trash"
                                                            value="{{ $contact['id'] }}" id="check-{{ $contact['id'] }}">
                                                        <label for="check1"></label>
                                                    </div>
                                                </td>
                                                @if ($contact['is_read'] == 0)
                                                    <td class="mailbox-star">
                                                        <a
                                                            href="{{ route('dashboard-contact-edit', ['id' => $contact['id']]) }}">
                                                            <i class="fas fa-star text-warning"></i>
                                                        </a>
                                                    </td>
                                                @else
                                                    <td class="mailbox-star">
                                                        <a
                                                            href="{{ route('dashboard-contact-edit', ['id' => $contact['id']]) }}">
                                                            <i class="fas fa-star text-secondary"></i>
                                                        </a>
                                                    </td>
                                                @endif
                                                <td class="mailbox-name">
                                                    <a
                                                        href="{{ route('dashboard-contact-edit', ['id' => $contact['id']]) }}">{{ $contact['name'] }}</a>
                                                </td>
                                                <td class="mailbox-attachment">
                                                    @if ($contact['label'] == 'important')
                                                        <i class="far fa-circle text-warning"></i>
                                                    @elseif ($contact['label'] == 'offers')
                                                        <i class="far fa-circle text-light"></i>
                                                    @elseif ($contact['label'] == 'complaint')
                                                        <i class="far fa-circle text-danger"></i>
                                                    @elseif ($contact['label'] == 'suggestion')
                                                        <i class="far fa-circle text-primary"></i>
                                                    @elseif ($contact['label'] == 'compliment')
                                                        <i class="far fa-circle text-success"></i>
                                                    @else
                                                        <i class="far fa-circle text-secondary"></i>
                                                    @endif
                                                </td>
                                                <td class="mailbox-subject">
                                                    <b>{{ $contact['subject'] }}</b>
                                                </td>
                                                <td class="mailbox-date">{{ $contact['created_at'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- /.table -->
                            </div>
                            <!-- /.mail-box-messages -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer p-0">
                            <div class="mailbox-controls">
                                <!-- Check all button -->
                                <button type="button" class="btn btn-default btn-sm checkbox-toggle">
                                    <i class="far fa-square"></i>
                                </button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </div>
                                <!-- /.btn-group -->
                                <button type="button" class="btn btn-default btn-sm">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                                <div class="float-right">
                                    1-50/200
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-sm">
                                            <i class="fas fa-chevron-left"></i>
                                        </button>
                                        <button type="button" class="btn btn-default btn-sm">
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
                                    </div>
                                    <!-- /.btn-group -->
                                </div>
                                <!-- /.float-right -->
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

@endsection
