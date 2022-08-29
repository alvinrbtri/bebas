<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    {{-- link css --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">

</head>
<body>
    <div class="container mt-3">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">CRUD-coba</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('/')}}">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('/mahasiswa')}}">Fitur</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                  </li>
                </ul>
              </div>
            </div>
        </nav>

        <div class="container">
            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
            <div class="row">
                
                    {{-- <div class="card mt-5 col-md-3" style="margin: 5px">
                        <div class="card-body">
                        <h5 class="card-title">{{ $mhs->nama }}</h5>
                        <h5 class="card-subtitle mb-2 text-muted">{{ $mhs->nim }}</h5>
                        <p class="card-text">{{ $mhs->jurusan }}</p>
                        <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $mhs->id }}">Edit</a>
                        <a href="#" class="btn btn-success">Hapus</a>
                        </div>
                    </div> --}}
                    <table class="table table-striped mt-5">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Nama</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Jurusan</th>
                            <th scope="col">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($mahasiswa as $mhs)
                          <tr>
                            <th scope="row">{{ $loop->iteration}}</th>
                            <th>
                              <img src="{{ asset('storage/kategori-images/' . $mhs->gambar)}}" class="img-fluid">{{$mhs->gambar}}</th>
                            <td>{{$mhs->nama}}</td>
                            <td>{{$mhs->nim}}</td>
                            <td>{{$mhs->jurusan}}</td>
                            <td>
                                <a href="" class="btn btn-primary" data-bs-toggle="modal" 
                                data-bs-target="#exampleModal-{{ $mhs->id }}">Edit</a>
                                <a href="" class="btn btn-success" data-bs-toggle="modal" 
                                data-bs-target="#exampleModal1-{{ $mhs->id }}">Detail</a>
                                <a rel="{{ $mhs->id }}" rel1="mahasiswa" href="javascript:" class="btn btn-danger" 
                                  id="deletemahasiswa">Hapus</a>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
            </div>
        </div>

        {{-- Modal Edit--}}
        @foreach ($mahasiswa as $mhsa)
            <div class="modal fade" id="exampleModal-{{ $mhsa->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form action=" {{ url('/edit'. $mhsa->id) }} " method="post">
                            @csrf
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ $mhsa->nama }}">
                                @error('nama')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>NIM</label>
                                <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror" value="{{ $mhsa->nim }}">
                                @error('nim')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Jurusan</label>
                                <input type="text" class="form-control @error('jurusan') is-invalid @enderror" name="jurusan" value="{{ $mhsa->jurusan }}">
                                @error('jurusan')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
                </div>
                </div>
            </div>
            
        @endforeach

        {{-- Modal view--}}
        @foreach ($mahasiswa as $maha)
            <div class="modal fade" id="exampleModal1-{{ $maha->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        hhhhhhhhhhhhhh
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
                </div>
                </div>
            </div>
            
        @endforeach

    </div>
    {{-- link js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
    <script>
      $(document).ready(function(){
        $('#deletemahasiswa').click(function(){
          var id = $(this).attr('rel');
          var deleteFunction = $(this).attr('rel1')
          swal({
            title: "Are you sure?",
            text: "Your will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
          },
            function(){
              window.location.href="/delete/"+deleteFunction+"/"+id;
              swal("Deleted!", "Your imaginary file has been deleted.", "success");
          });
        });
      });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>