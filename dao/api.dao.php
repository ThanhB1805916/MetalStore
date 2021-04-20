<div id="items" style="display: none;">
    <?php
        if(isset($_GET["param"]))
        {
            require_once "dao.php";
            
            function items(){
                $dao = new ItemDAO();
                $items = $dao->getAllItem();

                $output = [];

                foreach ($items as $value) {
                    $output[] = [
                        "MSHH" => $value["MSHH"],
                        "TenHH" => $value["TenHH"]
                    ];
                }
                var_dump($items);
                // echo json_encode($output); 
            }

            $_GET["param"]();
        }
    ?>
</div>
<script>
    var div = document.getElementById("items");
    var myData = div.textContent;

    document.write(myData);

    // var arr = <?php items()?>

    // document.write(JSON.stringify(arr));
</script>