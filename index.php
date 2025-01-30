<?php 

//include header File
include_once 'header.php';

// Importing the necessary Functions
include_once 'includes/functions.inc.php';

// Importing Database Connection
include_once 'includes/dbh.inc.php';

// Get all the books
$books = fetchAllBooks($conn);

?>
<div class="books-container" style="margin-top: 10px; display: flex; flex-wrap: wrap; flex; flex-direction: row; gap: 150px; margin-left: 10px;">
<?php foreach ($books as $book): ?>
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
<?php endforeach; ?>
</div>

<?php

//include footer file
include_once 'footer.php' 

?>




