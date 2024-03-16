@extends('layout.main')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1>{{ $title }}</h1> --}}
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row mb-2">
                <!-- left column -->
                <div class="col-md-6">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ $title }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{ route($aksi) }}" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tahun</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" name="fin_year" id="fin_year">
                                            <option value="">-- Pilih --</option>
                                            @foreach ($tahun as $th)
                                                @if (old('fin_year') == $th['id'])
                                                    <option value="{{ $th['id'] }}" selected>{{ $th['name'] }}
                                                    </option>
                                                @else
                                                    <option value="{{ $th['id'] }}">{{ $th['name'] }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('fin_year')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }} </strong>
                                            </div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Bulan</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" name="fin_month" id="fin_month">
                                            <option value="">-- Pilih --</option>
                                            @foreach ($bulan as $th)
                                                @if (old('fin_month') == $th['id'])
                                                    <option value="{{ $th['id'] }}" selected>{{ $th['name'] }}
                                                    </option>
                                                @else
                                                    <option value="{{ $th['id'] }}">{{ $th['name'] }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('fin_month')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }} </strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Tower</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" name="tower" id="tower">
                                            <option value="">-- Pilih --</option>
                                            <option value="0">ALL</option>
                                            @foreach ($tower as $th)
                                                @if (old('tower') == $th->id)
                                                    <option value="{{ $th->id }}" selected>{{ $th->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $th->id }}">{{ $th->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('tower')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }} </strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">sampai</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" name="tower2" id="tower2">
                                            <option value="">-- Pilih --</option>
                                            <option value="0">ALL</option>
                                            @foreach ($tower as $th)
                                                @if (old('tower2') == $th->id)
                                                    <option value="{{ $th->id }}" selected>{{ $th->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $th->id }}">{{ $th->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('tower2')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }} </strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Lantai</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" name="lantai" id="lantai">
                                            <option value="">-- Pilih --</option>
                                            <option value="0">ALL</option>
                                            @foreach ($lantai as $th)
                                                @if (old('lantai') == $th->kode)
                                                    <option value="{{ $th->kode }}" selected>{{ $th->kode }}
                                                    </option>
                                                @else
                                                    <option value="{{ $th->kode }}">{{ $th->kode }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('lantai')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }} </strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">sampai</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" name="lantai2" id="lantai2">
                                            <option value="">-- Pilih --</option>
                                            <option value="0">ALL</option>
                                            @foreach ($lantai as $th)
                                                @if (old('lantai2') == $th->kode)
                                                    <option value="{{ $th->kode }}" selected>{{ $th->kode }}
                                                    </option>
                                                @else
                                                    <option value="{{ $th->kode }}">{{ $th->kode }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('lantai2')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }} </strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Block</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" name="block" id="block">
                                            <option value="">-- Pilih --</option>
                                            <option value="0">ALL</option>
                                            @foreach ($block as $th)
                                                @if (old('block') == $th->block)
                                                    <option value="{{ $th->block }}" selected>{{ $th->block }}
                                                    </option>
                                                @else
                                                    <option value="{{ $th->block }}">{{ $th->block }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('block')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }} </strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">sampai</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" name="block2" id="block2">
                                            <option value="">-- Pilih --</option>
                                            <option value="0">ALL</option>
                                            @foreach ($block as $th)
                                                @if (old('block2') == $th->block)
                                                    <option value="{{ $th->block }}" selected>{{ $th->block }}
                                                    </option>
                                                @else
                                                    <option value="{{ $th->block }}">{{ $th->block }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('block2')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }} </strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Submit</button>
                                {{-- <button type="submit" class="btn btn-default float-right">Cancel</button> --}}
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
