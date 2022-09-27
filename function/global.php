<?php
require_once('guimail.php');
/**
 * Tạo ra 1 thẻ table chứa dữ liệu từ câu truy vấn  
 * @param mysqli_result $result A result set identifier returned by mysqli_query(), mysqli_store_result() or mysqli_use_result().
 * @param string $editPath đường dẫn tới trang Edit
 * @param string $deletePath đường dẫn tới trang Delete
 * @param string $detailsPath đường dẫn tới trang xem chi tiết
 * @param string $imagePath đường dẫn tới thư mục chứa ảnh
 * @param array $tableHeaders là mảng chứa tên các cột (header) của table
 * @param array $tableData [optional] là mảng có dạng 'tên cột trong dữ liệu' => 'định dạng',
 * nếu không cần định dạng dữ liệu thì không cần dùng.  
 * Các định dạng hỗ trợ: image, bool, mặc định: hiển thị text
 * @param string $id1 khóa chính của bảng
 * @param string $id2 [optional] khóa chính thứ 2 của bảng 
 * @param int $maxPage [optional] số trang tối đa tính được khi phân trang
 * @param string $searchQuery [optional] phân trang hỗ trợ tìm kiếm, xem hàm getSearchQuery(array) để
 * biết thêm chi tiết
 * @example {1} $tableHeaders = array ('Mã', 'Ảnh', 'Giới tính', 'Tên')  
 * $tableData = array('ma' => null, 'anh' => 'image', 'gioi_tinh' => 'bool - Nam - Nữ', 'ten' => null)  
 * $maxPage = 5;  
 * buildTable(result, "EditPage.php", "DeletePage.php", tableHeaders, tableData, "ma");  
 * Lưu ý: Số tableHeaders phải bằng số tableData
 */
function buildTable(
    mysqli_result $result,
    string $editPath = "",
    string $deletePath = "",
    string $detailsPath = "",
    string $imagePath = "",
    array $tableHeaders,
    array $tableData = array(""),
    string $id1 = "",
    string $id2 = "",
    int $maxPage = 0,
    string $searchQuery = ""
) {
    if (count($tableHeaders) == mysqli_num_fields($result) || count($tableHeaders) == count($tableData)) {
        if (mysqli_num_rows($result) > 0) { ?>
            <div class="container">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <?php
                            foreach ($tableHeaders as $header) {
                                echo "<th>$header</th>";
                            }
                            if ($id1 !== "") {
                                echo "<th>Chức năng</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        ?>
                            <tr>
                                <?php
                                // nếu table data được truyền vào, tạo các thẻ <td> tương ứng với định dạng
                                if ($tableData != array("")) {
                                    foreach ($tableData as $tenCot => $dinhDang) {
                                        $dinhDangs = array_map('trim', explode('-', $dinhDang));
                                        echo "<td>";
                                        switch ($dinhDangs[0]) {
                                            case "image":
                                                echo "<img src ='" . $imagePath . $row[$tenCot] . "' alt='ảnh' style='width:50px; height: 50px' class='rounded-pill mx-auto'>";
                                                break;
                                            case "bool":
                                                echo $row[$tenCot] ? $dinhDangs[1] : $dinhDangs[2];
                                                break;
                                            case "email":
                                                echo maskEmail($row[$tenCot]);
                                                break;
                                            default:
                                                echo $row[$tenCot];
                                                break;
                                        }
                                        echo "</td>";
                                    }
                                } else {
                                    foreach ($row as $value) {
                                        echo "<td>$value</td>";
                                    }
                                }
                                if ($id1 !== "") {
                                ?>
                                    <td>
                                        <?php
                                        if ($id2 === "") {
                                            echo '<a href="' . $editPath . '?id1=' . $row[$id1] . '">Sửa</a> ';
                                            echo '<a href="' . $detailsPath . '?id1=' . $row[$id1] . '">Chi tiết</a> ';
                                            echo '<a href="' . $deletePath . '?id1=' . $row[$id1] . '">Xóa</a>';
                                        } else {
                                            // chưa test
                                            echo '<a href="' . $editPath . '?id1=' . $row[$id1] . '&id2=' . $row[$id2] . '">Sửa</a>';
                                            echo '<a href="' . $detailsPath . '?id1=' . $row[$id1] . '&id2=' . $row[$id2] . '">Sửa</a>';
                                            echo '<a href="' . $deletePath . '?id1=' . $row[$id1] . '&id2=' . $row[$id2] . '">Xóa</a>';
                                        }
                                        ?>
                                    </td>
                            </tr>
                    <?php
                                }
                            }
                    ?>
                    </tbody>
                </table>
                <?php
                if ($maxPage > 1) { ?>
                    <div class="d-flex justify-content-center">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <!-- tạo link tương ứng tới các trang -->
                                <?php
                                if ($_GET['page'] == 1) {
                                ?>
                                    <li class="page-item disabled">
                                        <a class="page-link">
                                            <span aria-hidden="true text-muted">&laquo;</span>
                                        </a>
                                    </li>
                                <?php
                                }
                                ?>
                                <?php
                                if ($_GET['page'] > 1) {
                                ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] . '?page=1' . $searchQuery ?>">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                <?php
                                }
                                ?>
                                </li>
                                <?php
                                for ($i = 1; $i <= $maxPage; $i++) { ?>
                                    <?php
                                    if ($i == $_GET['page']) { ?>
                                        <li class="page-item active disabled">
                                            <a class="page-link">
                                                <?php echo $i ?>
                                            </a>
                                        </li>
                                    <?php
                                    } else {
                                    ?>
                                        <li class="page-item">
                                            <a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] . '?page=' . $i . $searchQuery ?>">
                                                <?php echo $i ?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                <?php }
                                if ($_GET['page'] < $maxPage) {
                                ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] . '?page=' . $maxPage . $searchQuery ?>">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php
                                if ($_GET['page'] == $maxPage) {
                                ?>
                                    <li class="page-item disabled">
                                        <a class="page-link">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </nav>
                    </div>
                <?php }
                ?>
            </div>
<?php
        } else {
            echo "Không có dữ liệu";
        }
    } else {
        echo "Số header truyền vào phải bằng số cột dữ liệu";
    }
    mysqli_free_result($result);
}
/**
 * Tạo ra các thẻ \<option> cho thẻ \<select>
 * @param mysqli_result $result dữ liệu từ câu truy vấn
 * @param string $selectName name của thẻ <select>
 * @param string $idName tên của khóa
 * @param string $idValue giá trị muốn hiển thị cho khóa
 * @param string $selectedValue [optional] giá trị chọn mặc định, dùng cho trang Edit
 * 
 */
function buildDropDownList(mysqli_result $result, string $selectName, string $idName, string $idValue, string $selectedValue = null)
{
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_array($result)) {
            echo "<option value='" . $row[$idName] . "' ";
            if (isset($_REQUEST[$selectName]) && $_REQUEST[$selectName] == $row[$idName]) {
                echo "selected='selected'";
            } else if ($selectedValue == $row[$idName]) {
                echo "selected='selected'";
            }
            echo ">" . $row[$idValue] . "</option>";
        }
    }
    mysqli_free_result($result);
}

/**
 * Lấy id tiếp theo
 * @param msqli_result $result kết quả của câu query, câu query nên trả về hàng có khóa lớn nhất
 * @param string $idName tên của khóa
 * @param string $idPrefix prefix cho khóa
 * @param int $numLenght số lượng chữ số '0'
 * @example {1} $query = 'SELECT my_id FROM my_table ORDER BY my_id DESC LIMIT 1;  
 * Ví dụ ta lấy được my_id = "ID00015"  
 * $result = mysqli_result($conn, $query);  
 * getNextID($result, 'my_id', 'ID', 5) sẽ return "ID00016"
 */
function getNextID(mysqli_result $result, string $idName, string $idPrefix, int $numLength)
{
    $row = $result->fetch_assoc();
    // nếu dữ liệu trống thì sẽ trả về id đầu tiên
    if ($row == null) {
        return $idPrefix . str_pad('1', $numLength, '0', STR_PAD_LEFT);
    }
    $nextID = (int)filter_var($row[$idName], FILTER_SANITIZE_NUMBER_INT) + 1;
    $nextID = $idPrefix . str_pad($nextID, $numLength, '0', STR_PAD_LEFT);
    mysqli_free_result($result);
    return $nextID;
}

/**
 * Hiện ra hộp alert
 */
function phpAlert($msg)
{
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}

/**
 * Lấy search query trên thanh url. Sử dụng để hỗ trợ tìm kiếm khi phân trang
 * @param array $queryData mảng key => value, với key là name của input, value là value của input
 * @example {1} $ten = "Nguyen Van A"; $diaChi = "123 ABC"  
 * $queryData = array('tenInput' => $ten, 'diaChiInput' => $diaChi)  
 * getSearchQuery ($queryData) sẽ trả về chuỗi:  
 * &tenInput=Nguyen+Van+A&diaChiInput=123+ABC
 */
function getSearchQuery(array $queryData)
{
    return "&" . http_build_query($queryData);
}

/* ĐỪNG XÀI CÁI NÀY */
/**
 * Trả về tên mới cho file nếu file bị trùng
 * @param string $dirPath đường dẫn tới file
 * @param string $imageName tên file muốn kiểm tra  
 * @return string  Hàm sẽ thêm dãy số 1 vào trước tên file nếu file bị trùng
 */
function copyImage(string $dirPath, string $imageName): string
{
    // kiểm tra xem có file nào trùng tên hay không
    $files = glob($dirPath . $imageName);
    if ($files !== false) {
        // nếu bị trùng tên thì thêm số 1 trước tên file
        if (count($files) > 0) {
            /* foreach ($files as $file) {
                if (md5_file($dirPath.$imageName) == md5_file($dirPath.$file)) {
                    return $imageName;
                    break;
                }
            } */
            $imageName = "1" . $imageName;
            // đệ quy để tiếp tục kiểm tra
            return copyImage($dirPath, $imageName);
        }
    }
    return $imageName;
}
?>