<div class="container">
    <div class="section">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">Send emails</h1>
            </div>

            <div class="col-lg-12">
                <h3 class="page-header">Email ce biti poslat svim pretplacenim korisnicima</h3>
            </div>

        </div>

        <?php echo validation_errors(); ?>

        <?php echo form_open('admin/sendEmailToUsers') ?>

        <div class="form-group">
            <label for="subject">Subject <font color="red"> * </font></label>
            <textarea class="form-control" id="subject" name="subject" rows="1"><?php echo set_value('subject'); ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="message">Message <font color="red"> * </font></label>
            <textarea class="form-control" id="message" name="message" rows="4"><?php echo set_value('message'); ?></textarea>
        </div>

        <br/><br/>
        <input type="submit" value="Send" name="button" id="send-email" class="button" align="center"/>                                           

        <?php echo form_close() ?>
    </div>
</div>
