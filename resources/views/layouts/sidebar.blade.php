

<!DOCTYPE html>
    <html lang="en">
        
      <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Bootstrap 5 Side Bar Navigation</title>
        <!-- bootstrap 5 css -->
        <link
          rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css"
          integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK"
          crossorigin="anonymous"
        />
        <!-- custom css -->
        <!-- <link rel="stylesheet" href="style.css" /> -->
        <link
          rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"
        />
        <style>
          li {
            list-style: none;
            margin: 20px 0 20px 0;
            margin-bottom: 40px;
          }
    
          a {
            text-decoration: none;
          }
    
          .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            margin-left: -300px;
            transition: 0.4s;
          }
    
          .active-main-content {
            margin-left: 250px;
          }
    
          .active-sidebar {
            margin-left: 0;
          }
    
          #main-content {
            transition: 0.4s;
          }
        </style>
      </head>
    
      <body>
        <div>
          <div class="sidebar p-4 bg-success" id="sidebar">
            <h4 class="mt-4 text-center text-white">Batik Kiki</h4>
            <p class="mb-5 mt-1 text-center text-white">Manajemen Penjualan Apps</p>

            <li>
              <a class="text-white" href="{{route('produk')}}">
                <i class="bi bi-boxes mr-2"></i>
                Produk
              </a>
            </li>
            
            <li>
              <a class="text-white" href="{{route('penjualan')}}">
                <i class="bi bi-wallet mr-2"></i>
                Penjualan
              </a>
            </li>
            @if(Auth::user()->is_Admin == 1)
            <li>
              <a class="text-white" href="{{route('biaya')}}">
                <i class="bi bi-graph-down mr-2"></i>
                Pengeluaran Biaya
              </a>
            </li>
            <li>
              <a class="text-white" href="{{route('user')}}">
                <i class="bi bi-person-badge mr-2"></i>
                Pegawai
              </a>
            </li>
            <li>
              <a class="text-white" href="{{route('laporanKeuangan')}}">
                <i class="bi bi-book mr-2"></i>
                Laporan Keuangan
              </a>
            </li>
            @endif
          </div>
          <br>
        </div>
        <div class="p-4" id="main-content">
          <button class="btn btn-success" id="button-toggle">
            <i class="bi bi-list"></i>
          </button>
          <div class="card mt-5">
            <div class="card-body">
              {{ $slot }}
            </div>
          </div>
        </div>
    
        <script>
    
          // event will be executed when the toggle-button is clicked
          document.getElementById("button-toggle").addEventListener("click", () => {
    
            // when the button-toggle is clicked, it will add/remove the active-sidebar class
            document.getElementById("sidebar").classList.toggle("active-sidebar");
    
            // when the button-toggle is clicked, it will add/remove the active-main-content class
            document.getElementById("main-content").classList.toggle("active-main-content");
          });
    
        </script>
      </body>
    </html>