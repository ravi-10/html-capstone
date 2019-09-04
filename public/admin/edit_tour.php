<?php
    /**
     * Admin Edit Tour Page 
     * last_update: 2019-09-04
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../../app/atg_config.php';

    use App\TourModel;

    $title = 'ATG - Admin Edit Tour';
    $heading = 'Edit Tour';

    $obj_tour = new TourModel;
    

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
                        <form>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Tour Title" value="">
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control" id="category" name="category">
                                    <option>Select Category</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="featured_image">Featured Image</label>
                                <input type="text" class="form-control" id="featured_image" name="featured_image" placeholder="Featured Image" value="">
                            </div>
                            <div class="form-group">
                                <label for="thumbnail_image">Thumbnail Image</label>
                                <input type="text" class="form-control" id="thumbnail_image" name="thumbnail_image" placeholder="Thumbnail Image" value="">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="from_date">From Date</label>
                                <input type="text" class="form-control" id="from_date" name="from_date" placeholder="From Date" value="">
                            </div>
                            <div class="form-group">
                                <label for="to_date">To Date</label>
                                <input type="text" class="form-control" id="to_date" name="to_date" placeholder="To Date" value="">
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" id="price" name="price" placeholder="Price" value="">
                            </div>
                            <div class="form-group">
                                <label for="booking_ends">Booking Ends</label>
                                <input type="text" class="form-control" id="booking_ends" name="booking_ends" placeholder="Booking Ends" value="">
                            </div>
                            <div class="form-group">
                                <label for="max_allowed_bookings">Maximum Allowed Bookings</label>
                                <input type="text" class="form-control" id="max_allowed_bookings" name="max_allowed_bookings" placeholder="Booking Ends" value="">
                            </div>
                            <div class="form-group">
                                <label for="is_published">is Published?</label>
                                <input type="text" class="form-control" id="is_published" name="is_published" placeholder="Is Published" value="">
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