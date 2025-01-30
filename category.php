<?php 

//include header File
include_once 'header.php';

// Importing the necessary Functions
include_once 'includes/functions.inc.php';

// Importing Database Connection
include_once 'includes/dbh.inc.php';

$books = fetchAllBooks($conn);
$categories = fetchAllCategory($conn);

?>

<div style="display: flex; flex-wrap: wrap; margin-top: 50px;">
<?php foreach ($categories as $category): ?>
  <div class="category" id="<?php echo $category['ID'];?>"  onclick="listBooks(<?php echo $category['ID'];?>)" style="font-weight: bold; background-color: rgb(101, 18, 18); color: white; font-size: 17px; height: 50px; padding-top: 10px;  margin-bottom: 50px; margin-top: 40px; width: 30%; margin-left: 120px; text-align: center; box-shadow: 1px 0.5px 1px 0.1px gray;">
    <h5><?php echo($category['CATAEGORY_NAME']); ?></h5>
  </div>
  <!--Container for books under a single category -->
  <div class="books-container" id="category<?php echo $category['ID'];?>" style="margin-left: 120px; border-color: gray; border-radius: 2px; border-style: solid; border-width: 0px; margin-top: 10px; display: none; flex-wrap: wrap; flex; flex-direction: row; gap: 100px;">
    <?php foreach ($books as $book): ?>
    <?php if ($book['CATEGORY_ID'] == $category['ID']): ?>
    <div class="book" style="margin-bottom: 20px;width: 390px; padding: 30px;">
      <div class="book-image" style="width:;">  
        <img src=<?php echo ($book['IMAGE_PATH']); ?>>
      </div>
      <div class="book-info">
        <h5><?php echo($book['BOOK_TITLE']); ?></h5>
        <p><?php echo($book['BOOK_AUTHOR']); ?></p>
      </div>
      <div class="button">
        <a href=<?php echo ($book['PDF_PATH']); ?> target="_blank">
          <button class="read-button" style="width: 30%; height: 40px; border-radius: 5px; border: none; font-style: bold; color: white; background-color: black;" > Read </button>
        </a>
        <a href=<?php echo ($book['PDF_PATH']); ?> target="_blank">
          <button class="read-button" style="width: 30%; height: 40px; border-radius: 5px; border: none; font-style: bold; color: white; background-color: black;" > Add To Favourite </button>
        </a>   
    </div>
    </div>

<?php endif; ?>

<?php endforeach; ?>
    </div>

<?php endforeach; ?>

    </div>

<?php include_once 'footer.php' ?>

<script>
  function listBooks(categoryId){ /*hide or show books based on click event */
    // Target the books container of a specific category with id categoryID 
    let categoryContainer = document.getElementById("category" + categoryId);

    // If the current display property is flex which means the books are visible change it to none to hide the books
    if (categoryContainer.style.display == 'flex'){
      categoryContainer.style.display = 'none';
    }
    else{
      // Since the books are hidden make them visible 
      categoryContainer.style.display = 'flex';
    }
}
</script>



