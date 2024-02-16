<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container">
        <div class="row">
            <div class="col-md-12"> <br>
                <h3>CRUD ข้อมูลการจองคิวสำหรับ จนท.เท่านั้น!!! <a href="AddQueue.php" class="btn btn-info float-end">+เพิ่มข้อมูลการจองคิว</a>
                </h3> <br />
                <table id="PatientTable" class="display table table-striped  table-hover table-responsive table-bordered ">

                    <thead align="center">
                        <tr>
                        <th width="10%">วันที่จองเข้ารับการรักษา</th>
                            <th width="10%">รหัสคิว</th>
                            <th width="25%">ชื่อ - นามสกุล</th>
                            <th width="10%">เพศ</th>
                            <th width="10%">ภาพผู้ป่วย</th>
                            <th width="15%">สถานะคิว</th>
                            <th width="5%">แก้ไข</th>
                            <th width="5%">ลบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require 'connect.php';
                        $sql = "SELECT * FROM queues,patient,gender where patient.Pid=queues.Pid and gender.genderID=patient.Pgender";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        foreach ($result as $r) { ?>
                            <tr>
                                <td><?= $r['QDate'] ?></td>
                                <td><?= $r['QNumber'] ?></td>
                                <td><?= $r['Pname'] ?></td>
                                <td><?= $r['Pgender'] ?></td>
                                <td><img src="picture/<?= $r['Image']; ?>" width="50px" height="50" alt="Image" onclick="enlargeImg()" id="img1"></td>
                                <td><?= $r['QStatus'] ?></td>
                                <td><a href="UpdateQueueForm.php?Pid=<?= $r['Pid'];?>&QDate=<?php echo $result["QDate"];?>"<?php echo $result["Pid"]; ?> class="btn btn-warning btn-sm">แก้ไข</a></td>
                                <td><a href="DeleteQueue.php?CustomerID=<?= $r['Pid'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบข้อมูล !!');">ลบ</a></td>
                                    </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Enlarged Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="enlargedImage" src="" alt="Enlarged Image" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            let table = $('#customerTable').DataTable();
        });

        function enlargeImg(imagePath) {
            $('#enlargedImage').attr('src', '../image/' + imagePath);
        }
    </script>
</body>

</html>