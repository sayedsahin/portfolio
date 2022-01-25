<div class="row justify-content-center">
    <div class="col-lg-8 col-xl-7">
        <form id="contactForm" method="post" action="<?= BASE_URL; ?>/contact">
            <!-- Name input-->
            <div class="form-floating mb-3">
                <input name="name" class="form-control" id="name" type="text" placeholder="Enter your name..." required />
                <label for="name">Full name*</label>
            </div>
            <!-- Email address input-->
            <div class="form-floating mb-3">
                <input name="email" class="form-control" id="email" type="email" placeholder="name@example.com" required />
                <label for="email">Email address*</label>
            </div>
            <!-- Phone number input-->
            <div class="form-floating mb-3">
                <input name="phone" class="form-control" id="phone" type="tel" placeholder="(123) 456-7890" />
                <label for="phone">Phone number (optional)</label>
            </div>
            <!-- Message input-->
            <div class="form-floating mb-3">
                <textarea name="body" class="form-control" id="message" type="text" placeholder="Enter your message here..." style="height: 10rem"></textarea>
                <label for="message">Message*</label>
            </div>

            <div id="submitMessage">
                <?php message(); ?>
            </div>
            <!-- Submit Button-->
            <button class="btn btn-primary btn-xl" id="submitButton" type="submit">Send</button>
        </form>
    </div>
</div>