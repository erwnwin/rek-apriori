<br>
<div class="container py-2 mt-4">
    <div class="d-flex justify-content-between align-items-center mt-2 p-3 bg-light shadow rounded-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="<?= base_url('myhome') ?>" class="text-decoration-none text-primary">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Account</li>
            </ol>
        </nav>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <div class="jumbotron">
                <h1 class="display-6">Hai, <?=
                                            $this->session->userdata('first_name');
                                            ?></h1>
                <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
            </div>
        </div>

    </div>

    <div class="row mb-3">
        <!-- Kolom pertama dengan lebar 8 kolom pada layar besar, 12 kolom pada layar kecil -->
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-user"></i> Account Profile
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Misalnya $users adalah array yang berisi data pengguna
                            $users = [
                                ['first_name' => 'John', 'last_name' => 'Doe', 'handle' => '@john_doe'],
                                ['first_name' => 'Jane', 'last_name' => 'Smith', 'handle' => '@jane_smith'],
                                ['first_name' => 'Michael', 'last_name' => 'Johnson', 'handle' => '@mike_johnson']
                            ];

                            // Loop untuk menampilkan setiap data pengguna
                            foreach ($users as $index => $user) {
                                echo "<tr>";
                                echo "<th scope='row'>" . ($index + 1) . "</th>";
                                echo "<td>" . $user['first_name'] . "</td>";
                                echo "<td>" . $user['last_name'] . "</td>";
                                echo "<td>" . $user['handle'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>

        <!-- Kolom kedua dengan lebar 4 kolom pada layar besar, 12 kolom pada layar kecil -->
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-header">
                    Featured
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    </div>


</div>