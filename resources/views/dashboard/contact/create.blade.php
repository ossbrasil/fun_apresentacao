@extends('layouts.dashboard')
@section('title', 'Contatos')
@section('nav-contact-open', 'menu-open')
@section('nav-contatc-ul', 'active')
@section('nav-contatc-li', 'active')
@section('content')

    <!-- summernote -->
    <link rel="stylesheet" href="{{ URL::to('assets/dashboard/plugins/summernote/summernote-bs4.min.css') }}">

    <div class="content-wrapper">
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
                                        <i class="far fa-envelope"></i> Não lidos
                                        <span class="badge bg-primary float-right">12</span>
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
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle text-danger"></i>
                                        Important
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle text-warning"></i> Promotions
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle text-primary"></i>
                                        Social
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
                            <h3 class="card-title">Cadastrar Contato</h3>

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
                        <form action="{{ route('dashboard-contact-store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="text" id="name" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Nome Completo:" value="{{ old('name') }}" autocomplete="off">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="email" id="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror" placeholder="Email:"
                                        value="{{ old('email') }}" autocomplete="off">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" id="subject" name="subject"
                                        class="form-control @error('subject') is-invalid @enderror" placeholder="Assunto:"
                                        value="{{ old('subject') }}" autocomplete="off">
                                    @error('subject')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <select name="label" id="label" name="label"
                                        class="form-control @error('label') is-invalid @enderror">
                                        <option value="">Selecione uma opção</option>
                                        <option value="important">Importante</option>
                                        <option value="compliment">Elogio</option>
                                        <option value="complaint">Reclamação</option>
                                        <option value="suggestion">Sugestão</option>
                                        <option value="other">Outros</option>
                                    </select>
                                    @error('label')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <textarea id="compose-textarea" name="message" id="message" class="form-control" rows="10"
                                        autocomplete="off">{{ old('message') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <a href="{{ route('dashboard-contact') }}" class="mr-3 btn btn-primary">Voltar</a>
                                    <button type="submit" class="btn btn-success">Cadastrar</button>
                                </div>
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
                                    <!-- /.float-right -->
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

    <!-- Summernote -->
    <script src="{{ URL::to('assets/dashboard/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(function() {
            //Add text editor
            $('#compose-textarea').summernote({
                height: 300
            })
        })
    </script>
@endsection
