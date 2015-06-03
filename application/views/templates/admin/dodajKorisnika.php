<div class="container">
    <div class="section">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">Dodaj korisnika</h1>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-6">
                <?php echo validation_errors(); ?>

                <?php echo form_open('admin/dodajNovogKorisnika') ?>

                <div class="form-group">
                    <label for="name" align="left">Username <font color="red"> * </font></label><br/>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo set_value('username'); ?>" spellcheck="false" maxlength="40" size="40"/>
                </div>

                <div class="form-group">
                    <label for="password">Lozinka <font color="red"> * </font></label><br/>
                    <input type="password" class="form-control" id="password" name="password"  maxlength="40" size="40"/>
                </div>

                <div class="form-group">
                    <label for="password">Ponovite lozinku <font color="red"> * </font></label><br/>
                    <input type="password" class="form-control" id="passwordagain" name="passwordagain" maxlength="40" size="40"  />
                </div>

                <div class="form-group">
                    <label for="email">Email <font color="red"> * </font></label><br/>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>" spellcheck="false" maxlength="40" size="40"/>
                </div>

                <div class="form-group">
                    <label for="role">Rola<font color="red"> * </font></label><br/>
                    <select id="role" name="role" class="form-control" value="<?php echo set_value('role'); ?>">
                        <?php
                        $roles = array('registrovan', 'kriticar', 'moderator', 'admin');
                        foreach ($roles as $role) {
                            $selected = $role == set_value('role') ? 'selected' : '';
                            echo '<option ' . $selected . ' value="' . $role . '">'.$role.'</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="telefon">Telefon<font color="red"> * </font></label><br/>
                    <input type="text" class="form-control" id="telefon" name="telefon" value="<?php echo set_value('telefon'); ?>" spellcheck="false" maxlength="40" size="40"  />
                </div>

                <div class="form-group">
                    <label for="starost">Godina rođenja <font color="red"> * </font></label><br/>
                    <select id="birthyear" name="birthyear" class="form-control">
                        <?php
                        for ($i = 60; $i >= 0; $i--) {
                            $year = 1945 + $i;
                            $selected = $year == set_value('birthyear') ? 'selected' : '';
                            echo " <option " . $selected . " value=\"" . $year . "\">" . $year . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="posta">Obaveštenja putem email-a?</label><br/>
                    <input type="checkbox" id="posta" name="posta" spellcheck="false"/>
                </div>

                <br/>
                <input type="submit" value="Registruj se!" name="button" id="create-account" class="button" align="center"/>                                           

                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>
