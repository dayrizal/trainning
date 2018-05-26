
          </h1>

          <!-- Blog Post -->
          <div class="card mb-4">
          <?php echo $blog->DetailPost() ?>
          <!-- Comments Form -->
          <div class="card my-4">
            <h5 class="card-header">Leave a Comment:</h5>
            <div class="card-body">
            <?php
              if(isset($_POST['submit'])){
                $blog->Comment();
              }
            ?>
              <form method="post" action="">
                <div class="form-group">
                  <input type="text" class="form-control" name="nama" />
                </div>
                <div class="form-group">
                  <textarea class="form-control" rows="3" name="comment"></textarea>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>

          <!-- Single Comment -->
          
            <?php $blog->ResComent(); ?>
          
        </div>
          <!-- Pagination -->
          <ul class="pagination justify-content-center mb-4">
            <li class="page-item">
              <a class="page-link" href="#">&larr; Older</a>
            </li>
            <li class="page-item disabled">
              <a class="page-link" href="#">Newer &rarr;</a>
            </li>
          </ul>