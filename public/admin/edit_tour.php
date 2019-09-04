<?php
    /**
     * Admin Edit Tour Page 
     * last_update: 2019-09-04
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../../app/atg_config.php';

    use App\TourModel;
    use App\CategoryModel;

    $title = 'ATG - Admin Edit Tour';
    $heading = 'Edit Tour';

    $obj_tour = new TourModel;
    $obj_category = new CategoryModel;

    $tour_id = $_GET['tour_id'];
    $tour = $obj_tour->one($tour_id);

    $categories = $obj_category->all();

    if('POST' == $_SERVER['REQUEST_METHOD']) {
        $affected_rows = $obj_tour->update($_POST);
        if($affected_rows>0) {
            header('Location: tours.php');
            die;
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
                        <form method="post" action="" novalidate>
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="tour_id" name="tour_id" value="<?=esc_attr($tour['tour_id'])?>">
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Tour Title" value="<?=esc_attr($tour['title'])?>">
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control" id="category" name="category">
                                    <option value="">Select Category</option>
                                    <?php foreach($categories as $category) : ?>
                                      <option value="<?=$category['category_id']?>" <?php echo ($category['category_id'] == $tour['category_id']) ? "selected" : ""; ?>>
                                        <?=$category['name']?>
                                      </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="featured_image">Featured Image</label>
                                <input type="text" class="form-control" id="featured_image" name="featured_image" placeholder="Featured Image" value="<?=esc_attr($tour['featured_image'])?>">
                            </div>
                            <div class="form-group">
                                <label for="thumbnail_image">Thumbnail Image</label>
                                <input type="text" class="form-control" id="thumbnail_image" name="thumbnail_image" placeholder="Thumbnail Image" value="<?=esc_attr($tour['thumbnail_image'])?>">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"><?=esc($tour['description'])?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" id="country" name="country" placeholder="Country" value="<?=esc_attr($tour['country'])?>">
                            </div>
                            <div class="form-group">
                                <label for="from_date">From Date</label>
                                <input type="text" class="form-control" id="from_date" name="from_date" placeholder="From Date" value="<?=esc_attr($tour['from_date'])?>">
                            </div>
                            <div class="form-group">
                                <label for="to_date">To Date</label>
                                <input type="text" class="form-control" id="to_date" name="to_date" placeholder="To Date" value="<?=esc_attr($tour['to_date'])?>">
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" id="price" name="price" placeholder="Price" value="<?=esc_attr($tour['price'])?>">
                            </div>
                            <div class="form-group">
                                <label for="booking_ends">Booking Ends</label>
                                <input type="text" class="form-control" id="booking_ends" name="booking_ends" placeholder="Booking Ends" value="<?=esc_attr($tour['booking_ends'])?>">
                            </div>
                            <div class="form-group">
                                <label for="max_allowed_bookings">Maximum Allowed Bookings</label>
                                <select class="form-control" id="max_allowed_bookings" name="max_allowed_bookings">
                                    <?php for($i=1; $i<=9; $i++): ?>
                                        <option value="<?=esc_attr($i)?>" <?php echo ($tour['max_allowed_bookings'] == $i) ? "selected" : ""; ?>>
                                            <?=esc($i)?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="is_published" name="is_published" <?php echo ($tour['is_published'] == true) ? "checked" : ""; ?>>
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