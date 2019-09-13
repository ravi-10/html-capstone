<?php
    /**
     * Admin Edit Tour Page 
     * last_update: 2019-09-04
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../../app/atg_config.php';

    use App\TourModel;
    use App\CategoryModel;
    use App\Validator;

    if(!$_SESSION['logged_in'] && $_SESSION['role'] != 'admin') {
        $_SESSION['flash'] = 'You must be logged in as admin
                                 to view edit tour page.';
        $_SESSION['flash_class'] = 'flash-info';
        if(!empty($_GET['tour_id'])){
            header('Location: ../login.php?request_from=admin/edit_tour.php?tour_id=' . $_GET['tour_id']);
        } else {
            header('Location: ../login.php?request_from=admin/edit_tour.php');
        }
        exit;
    }

    /*if(!isset($_GET['tour_id']) || empty($_GET['tour_id'])){
        $_SESSION['flash'] = "Please select a tour to edit";
        $_SESSION['flash_class'] = 'alert-info';
        header('Location: tours.php');
        die;
    }*/

    $title = 'ATG - Admin Edit Tour';
    $heading = 'Edit Tour';

    $obj_tour = new TourModel;
    $obj_category = new CategoryModel;

    $tour_id = $_GET['tour_id'];
    $tour = $obj_tour->one($tour_id);

    $categories = $obj_category->all('name', 'backend');

    $errors = [];
    $v = new Validator;

    if('POST' == $_SERVER['REQUEST_METHOD']) {

        foreach ($_POST as $key => $value) {
            // calling required function for all fields except is_published 
            // because it is a checkbox
            if ($key != 'is_published'){
                $v->required($key);
            }
        }
        $v->generalStringValidator('title');
        $v->generalStringValidator('country');
        $v->lengthForFullVarchar('title');
        $v->countryLength('country');
        $v->dateFormat('from_date');
        $v->dateFormat('to_date');
        $v->dateFormat('booking_ends');
        $v->dateNotFromPast('from_date');
        $v->dateNotFromPast('to_date');
        $v->dateNotFromPast('booking_ends');
        $v->toDateNotLessThanFromDate('from_date', 'to_date');
        $v->price('price');

        $errors = $v->getErrors();

        if(empty($errors)) {
            
            $featured_image = $_POST['prev_featured'];
            if(!empty($_FILES['featured_image']['tmp_name'])) {
                $target_path = '../images/uploads/tours/featured/';
                $file_name = $_FILES['featured_image']['name'];
                
                $file_name = uniqid() . '-' . $_FILES['featured_image']['name'];
                $source = $_FILES['featured_image']['tmp_name'];
                $destination = $target_path . $file_name;
                if(getimagesize($source)) {
                    move_uploaded_file($source, $destination);
                    $featured_image = $file_name;
                } else {
                    $errors['featured_image'] = 'The file you uploaded was not an image!';
                }
            }

            $thumbnail_image = $_POST['prev_thumb'];
            if(!empty($_FILES['thumbnail_image']['tmp_name'])) {
                $target_path = '../images/uploads/tours/thumbnail/';
                $file_name = $_FILES['thumbnail_image']['name'];
                
                $file_name = uniqid() . '-' . $_FILES['thumbnail_image']['name'];
                $source = $_FILES['thumbnail_image']['tmp_name'];
                $destination = $target_path . $file_name;
                if(getimagesize($source)) {
                    move_uploaded_file($source, $destination);
                    $thumbnail_image = $file_name;
                } else {
                    $errors['thumbnail_image'] = 'The file you uploaded was not an image!';
                }
            }

            $affected_rows = $obj_tour->update($_POST, $featured_image, $thumbnail_image);
            if($affected_rows>0) {
                $_SESSION['flash'] = "Tour updated successfully";
                $_SESSION['flash_class'] = 'alert-success';
                header('Location: tours.php');
                die;
            }
        }

    }

    // including head file
    require '../../inc/admin_head.inc.php';
?>

        <h1 class="dash-title"><?=esc($heading)?></h1>

        <div class="row">
            <div class="col">
                <div class="card spur-card">
                    <div class="card-header bg-secondary text-white">
                        <div class="spur-card-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <div class="spur-card-title"> Tour Form </div>
                    </div>
                    <div class="card-body">
                        <form method="post" 
                            action="<?=esc_attr($_SERVER['PHP_SELF'])?>" 
                            id="tour" enctype="multipart/form-data" 
                            novalidate>
                            <div class="form-group">
                                <input type="hidden" class="form-control" 
                                    id="tour_id" name="tour_id" 
                                    value="<?=cleanBackend('tour_id', $tour['tour_id'])?>">
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" 
                                    id="title" name="title" placeholder="Tour Title" 
                                    value="<?=cleanBackend('title', $tour['title'])?>">
                                <?php if(!empty($errors['title'])) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?=esc($errors['title'])?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control" id="category" 
                                    name="category">
                                    <option value="">Select Category</option>
                                    <?php foreach($categories as $category) : ?>
                                      <option value="<?=esc_attr($category['category_id'])?>" 
                                        <?php
                                            if($category['category_id'] == cleanBackend('category', $tour['category_id'])) {
                                                echo 'selected';
                                            } else {
                                                echo '';
                                            }
                                        ?>>
                                        <?=esc($category['name'])?>
                                      </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if(!empty($errors['category'])) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?=esc($errors['category'])?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="featured_image">Featured Image</label>
                                <?php
                                    $featured = cleanBackend('prev_featured', $tour['featured_image']);
                                    if(!empty($featured)) :
                                ?>
                                    <div class="featured">
                                        <img 
                                        src="../images/uploads/tours/featured/<?=esc_attr($featured)?>"
                                        class="img-fluid" 
                                        alt="<?=esc_attr($featured)?>">
                                        <input type="hidden" name="prev_featured"
                                        value="<?=esc_attr($featured)?>">
                                        <small>
                                            <?=esc($featured)?>
                                        </small>
                                    </div>
                                <?php endif; ?>
                                <input type="file" class="form-control" 
                                    id="featured_image" name="featured_image"
                                    placeholder="Featured Image"
                                    value="<?=cleanBackend('featured_image', $tour['featured_image'])?>">
                                
                                <?php if(!empty($errors['featured_image'])) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?=esc($errors['featured_image'])?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="thumbnail_image">Thumbnail Image</label>
                                <?php
                                    $thumb = cleanBackend('prev_thumb', $tour['thumbnail_image']);
                                    if(!empty($thumb)) :
                                ?>
                                    <div class="thumbnail">
                                        <img 
                                        src="../images/uploads/tours/thumbnail/<?=esc_attr($thumb)?>"
                                        class="img-fluid" 
                                        alt="<?=esc_attr($thumb)?>">
                                        <input type="hidden" name="prev_thumb"
                                        value="<?=esc_attr($thumb)?>">
                                        <small>
                                            <?=esc($thumb)?>
                                        </small>
                                    </div>
                                <?php endif; ?>
                                <input type="file" class="form-control" 
                                    id="thumbnail_image" name="thumbnail_image"
                                    placeholder="Thumbnail Image"
                                    value="<?=cleanBackend('thumbnail_image', $tour['thumbnail_image'])?>">
                                
                                <?php if(!empty($errors['thumbnail_image'])) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?=esc($errors['thumbnail_image'])?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" 
                                    name="description" 
                                    rows="3"><?=cleanBackend('description', $tour['description'])?></textarea>
                                <?php if(!empty($errors['description'])) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?=esc($errors['description'])?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" 
                                        id="country" name="country" 
                                        placeholder="Country" 
                                        value="<?=cleanBackend('country', $tour['country'])?>">
                                <?php if(!empty($errors['country'])) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?=esc($errors['country'])?></div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="from_date">From Date</label>
                                <input type="text" class="form-control" 
                                    id="from_date" name="from_date" 
                                    placeholder="From Date" 
                                    value="<?=cleanBackend('from_date', $tour['from_date'])?>">
                                <?php if(!empty($errors['from_date'])) : ?>
                                    <div class="alert alert-danger" 
                                        role="alert"><?=esc($errors['from_date'])?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="to_date">To Date</label>
                                <input type="text" class="form-control" 
                                    id="to_date" name="to_date" placeholder="To Date" 
                                    value="<?=cleanBackend('to_date', $tour['to_date'])?>">
                                <?php if(!empty($errors['to_date'])) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?=esc($errors['to_date'])?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" id="price" 
                                    name="price" placeholder="Price" 
                                    value="<?=cleanBackend('price', $tour['price'])?>">
                                <?php if(!empty($errors['price'])) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?=esc($errors['price'])?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="booking_ends">Booking Ends</label>
                                <input type="text" class="form-control" 
                                    id="booking_ends" name="booking_ends" 
                                    placeholder="Booking Ends" 
                                    value="<?=cleanBackend('booking_ends', $tour['booking_ends'])?>">
                                <?php if(!empty($errors['booking_ends'])) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?=esc($errors['booking_ends'])?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="max_allowed_bookings">Maximum Allowed Bookings</label>
                                <select class="form-control" id="max_allowed_bookings" 
                                    name="max_allowed_bookings">
                                    <?php for($i=1; $i<=9; $i++): ?>
                                        <option value="<?=esc_attr($i)?>" 
                                            <?php
                                                if($i == cleanBackend('max_allowed_bookings', $tour['max_allowed_bookings'])) {
                                                    echo 'selected';
                                                } else {
                                                    echo '';
                                                }
                                            ?>>
                                            <?=esc($i)?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                                <?php if(!empty($errors['max_allowed_bookings'])) : ?>
                                    <div class="alert alert-danger" 
                                        role="alert">
                                        <?=esc($errors['max_allowed_bookings'])?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" 
                                    id="is_published" name="is_published" 
                                    <?php
                                        if(cleanBackend('is_published', $tour['is_published'])) {
                                            echo 'checked';
                                        } else {
                                            echo '';
                                        }
                                    ?>>
                                    <label class="custom-control-label" for="is_published">is Published?</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
                        
<?php
    // including footer file
    require '../../inc/admin_footer.inc.php';
?>