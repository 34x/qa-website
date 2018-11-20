<?php
require_once(__DIR__ . '/header.php');
?>
<div class="col-sm-4">
<form>
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="foobar@example.com">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name">
  </div>
  <div class="form-group">
    <label for="comment">Comment</label>
    <textarea class="form-control" name="text" id="comment">

    </textarea>
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
<?php
require_once(__DIR__ . '/footer.php');

$db_url = $_SERVER['DATABASE_URL'];

$dbh = new PDO($db_url);

echo null !== $dbh;