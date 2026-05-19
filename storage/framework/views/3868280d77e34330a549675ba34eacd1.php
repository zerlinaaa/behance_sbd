<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an account | Behance</title>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --color-primary: #1473e6;
            --color-primary-hover: #0d66d0;
            --color-text: #2c2c2c;
            --color-muted: #6e6e6e;
            --color-border: #d0d0d0;
            --font-main: 'Source Sans 3', sans-serif;
        }

        body {
            font-family: var(--font-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .bg-wrap {
            position: fixed;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1776679768423-114637549209?w=1920&auto=format&fit=crop&q=85&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDUxfGJvOGpRS1RhRTBZfHxlbnwwfHx8fHw%3D');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            z-index: 0;
        }
        .bg-wrap::after {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(5, 15, 30, 0.50);
        }

        .brand-label {
            position: fixed;
            bottom: 56px;
            left: 48px;
            display: flex;
            align-items: center;
            gap: 14px;
            z-index: 2;
        }
        .brand-logo-box {
            width: 40px; height: 40px;
            background: #fff;
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; font-weight: 900; color: #1b1b1b;
            letter-spacing: -1px;
        }
        .brand-label span {
            font-size: 22px; font-weight: 700; color: #fff;
            letter-spacing: -0.3px;
        }

        .page-main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 40px 8% 40px 48px;
            position: relative;
            z-index: 1;
        }

        .auth-card {
            background: #fff;
            border-radius: 6px;
            padding: 44px 48px 48px;
            width: 448px;
            box-shadow: 0 12px 48px rgba(0,0,0,.28);
        }

        .step-label {
            font-size: 13px;
            color: var(--color-muted);
            margin-bottom: 6px;
        }
        .auth-card h1 {
            font-size: 30px;
            font-weight: 700;
            color: var(--color-text);
            margin-bottom: 10px;
            letter-spacing: -0.3px;
        }
        .auth-card .subtitle {
            font-size: 14px;
            color: var(--color-muted);
            margin-bottom: 28px;
        }
        .auth-card .subtitle a {
            color: var(--color-primary);
            text-decoration: none;
            font-weight: 600;
        }
        .auth-card .subtitle a:hover { text-decoration: underline; }

        .row-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-bottom: 20px;
        }

        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--color-text);
            margin-bottom: 6px;
        }
        .form-group label .info-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 14px; height: 14px;
            background: var(--color-primary);
            color: #fff;
            border-radius: 50%;
            font-size: 9px;
            font-weight: 700;
            margin-left: 4px;
            vertical-align: middle;
            cursor: default;
        }
        .form-group input[type="text"],
        .form-group input[type="number"] {
            width: 100%;
            padding: 10px 12px;
            border: 1.5px solid var(--color-border);
            border-radius: 4px;
            font-size: 15px;
            font-family: var(--font-main);
            color: var(--color-text);
            outline: none;
            transition: border-color .15s;
            background: #fff;
        }
        .form-group input:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 2px rgba(20,115,230,.15);
        }

        .dob-row {
            display: grid;
            grid-template-columns: 3fr 2fr;
            gap: 12px;
        }
        .select-wrap { position: relative; }
        .select-wrap select {
            width: 100%;
            padding: 10px 32px 10px 12px;
            border: 1.5px solid var(--color-border);
            border-radius: 4px;
            font-size: 15px;
            font-family: var(--font-main);
            color: var(--color-text);
            background: #fff;
            outline: none;
            appearance: none;
            -webkit-appearance: none;
            transition: border-color .15s;
            cursor: pointer;
        }
        .select-wrap select:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 2px rgba(20,115,230,.15);
        }
        .select-wrap::after {
            content: '';
            position: absolute;
            right: 12px; top: 50%;
            transform: translateY(-50%);
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 5px solid var(--color-muted);
            pointer-events: none;
        }

        .country-row {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .country-row .country-label {
            font-size: 13px;
            font-weight: 600;
            color: var(--color-text);
            white-space: nowrap;
        }
        .country-row .select-wrap { flex: 1; }
        .country-row select {
            border: none;
            border-bottom: 1.5px solid var(--color-border);
            border-radius: 0;
            padding: 4px 24px 4px 8px;
            font-size: 14px;
            background: transparent;
        }
        .country-row select:focus {
            box-shadow: none;
            border-color: var(--color-primary);
        }
        .country-row .select-wrap::after {
            border-top-color: var(--color-muted);
        }

        .separator {
            border: none;
            border-top: 1px solid #e8e8e8;
            margin: 24px 0 18px;
        }

        .legal {
            font-size: 12px;
            color: var(--color-muted);
            line-height: 1.55;
            margin-bottom: 14px;
        }
        .legal a {
            color: var(--color-text);
            text-decoration: underline;
        }
        .legal a:hover { color: var(--color-primary); }

        .check-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 16px;
        }
        .check-row input[type="checkbox"] {
            width: 14px; height: 14px;
            accent-color: var(--color-primary);
            cursor: pointer;
            flex-shrink: 0;
        }
        .check-row label {
            font-size: 13px;
            color: var(--color-text);
            cursor: pointer;
        }

        .btn-continue {
            display: block;
            margin-left: auto;
            background: var(--color-primary);
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 10px 30px;
            font-size: 15px;
            font-weight: 700;
            font-family: var(--font-main);
            cursor: pointer;
            transition: background .15s;
            margin-top: 8px;
        }
        .btn-continue:hover { background: var(--color-primary-hover); }

        .page-footer {
            position: relative;
            z-index: 2;
            background: #fff;
            padding: 13px 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            font-size: 12px;
            color: #6e6e6e;
            flex-wrap: wrap;
        }
        .page-footer a { color: #6e6e6e; text-decoration: none; }
        .page-footer a:hover { text-decoration: underline; }
        .page-footer-sep { color: #ccc; }
    </style>
</head>
<body>

    <div class="bg-wrap"></div>

    <div class="brand-label">
        <div class="brand-logo-box">Be</div>
        <span>Behance</span>
    </div>

    <main class="page-main">
        <div class="auth-card">
            <p class="step-label">Step 2 of 2</p>
            <h1>Create an account</h1>
            <p class="subtitle">Already have an account? <a href="<?php echo e(route('login')); ?>">Sign in</a></p>

            <form method="POST" action="<?php echo e(route('register2')); ?>">
                <?php echo csrf_field(); ?>

                <div class="row-2">
                    <div class="form-group" style="margin-bottom:0">
                        <label>First name</label>
                        <input type="text" name="first_name" value="<?php echo e(old('first_name')); ?>" autocomplete="given-name" required>
                        <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p style="color:#eb1000;font-size:12px;margin-top:4px;"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group" style="margin-bottom:0">
                        <label>Last name</label>
                        <input type="text" name="last_name" value="<?php echo e(old('last_name')); ?>" autocomplete="family-name" required>
                        <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p style="color:#eb1000;font-size:12px;margin-top:4px;"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="form-group" style="margin-top:20px;">
                    <label>Date of birth <span class="info-btn">i</span></label>
                    <div class="dob-row">
                        <div class="select-wrap">
                            <select name="birth_month">
                                <option value="" disabled selected>Select...</option>
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>
                        <input type="number" name="birth_year" placeholder="Year" min="1900" max="<?php echo e(date('Y')); ?>" value="<?php echo e(old('birth_year')); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="country-row">
                        <span class="country-label">Country/Region</span>
                        <div class="select-wrap">
                            <select name="country">
                                <option value="Afghanistan">Afghanistan</option>
                                <option value="Albania">Albania</option>
                                <option value="Algeria">Algeria</option>
                                <option value="Andorra">Andorra</option>
                                <option value="Angola">Angola</option>
                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                <option value="Argentina">Argentina</option>
                                <option value="Armenia">Armenia</option>
                                <option value="Australia">Australia</option>
                                <option value="Austria">Austria</option>
                                <option value="Azerbaijan">Azerbaijan</option>
                                <option value="Bahamas">Bahamas</option>
                                <option value="Bahrain">Bahrain</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Barbados">Barbados</option>
                                <option value="Belarus">Belarus</option>
                                <option value="Belgium">Belgium</option>
                                <option value="Belize">Belize</option>
                                <option value="Benin">Benin</option>
                                <option value="Bhutan">Bhutan</option>
                                <option value="Bolivia">Bolivia</option>
                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                <option value="Botswana">Botswana</option>
                                <option value="Brazil">Brazil</option>
                                <option value="Brunei">Brunei</option>
                                <option value="Bulgaria">Bulgaria</option>
                                <option value="Burkina Faso">Burkina Faso</option>
                                <option value="Burundi">Burundi</option>
                                <option value="Cabo Verde">Cabo Verde</option>
                                <option value="Cambodia">Cambodia</option>
                                <option value="Cameroon">Cameroon</option>
                                <option value="Canada">Canada</option>
                                <option value="Central African Republic">Central African Republic</option>
                                <option value="Chad">Chad</option>
                                <option value="Chile">Chile</option>
                                <option value="China">China</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Comoros">Comoros</option>
                                <option value="Congo (Congo-Brazzaville)">Congo (Congo-Brazzaville)</option>
                                <option value="Congo (DRC)">Congo (DRC)</option>
                                <option value="Costa Rica">Costa Rica</option>
                                <option value="Croatia">Croatia</option>
                                <option value="Cuba">Cuba</option>
                                <option value="Cyprus">Cyprus</option>
                                <option value="Czech Republic">Czech Republic</option>
                                <option value="Denmark">Denmark</option>
                                <option value="Djibouti">Djibouti</option>
                                <option value="Dominica">Dominica</option>
                                <option value="Dominican Republic">Dominican Republic</option>
                                <option value="Ecuador">Ecuador</option>
                                <option value="Egypt">Egypt</option>
                                <option value="El Salvador">El Salvador</option>
                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                <option value="Eritrea">Eritrea</option>
                                <option value="Estonia">Estonia</option>
                                <option value="Eswatini">Eswatini</option>
                                <option value="Ethiopia">Ethiopia</option>
                                <option value="Fiji">Fiji</option>
                                <option value="Finland">Finland</option>
                                <option value="France">France</option>
                                <option value="Gabon">Gabon</option>
                                <option value="Gambia">Gambia</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Germany">Germany</option>
                                <option value="Ghana">Ghana</option>
                                <option value="Greece">Greece</option>
                                <option value="Grenada">Grenada</option>
                                <option value="Guatemala">Guatemala</option>
                                <option value="Guinea">Guinea</option>
                                <option value="Guinea-Bissau">Guinea-Bissau</option>
                                <option value="Guyana">Guyana</option>
                                <option value="Haiti">Haiti</option>
                                <option value="Honduras">Honduras</option>
                                <option value="Hungary">Hungary</option>
                                <option value="Iceland">Iceland</option>
                                <option value="India">India</option>
                                <option value="Indonesia" selected>Indonesia</option>
                                <option value="Iran">Iran</option>
                                <option value="Iraq">Iraq</option>
                                <option value="Ireland">Ireland</option>
                                <option value="Israel">Israel</option>
                                <option value="Italy">Italy</option>
                                <option value="Jamaica">Jamaica</option>
                                <option value="Japan">Japan</option>
                                <option value="Jordan">Jordan</option>
                                <option value="Kazakhstan">Kazakhstan</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Kiribati">Kiribati</option>
                                <option value="Korea, North">Korea, North</option>
                                <option value="Korea, South">Korea, South</option>
                                <option value="Kosovo">Kosovo</option>
                                <option value="Kuwait">Kuwait</option>
                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                <option value="Laos">Laos</option>
                                <option value="Latvia">Latvia</option>
                                <option value="Lebanon">Lebanon</option>
                                <option value="Lesotho">Lesotho</option>
                                <option value="Liberia">Liberia</option>
                                <option value="Libya">Libya</option>
                                <option value="Liechtenstein">Liechtenstein</option>
                                <option value="Lithuania">Lithuania</option>
                                <option value="Luxembourg">Luxembourg</option>
                                <option value="Madagascar">Madagascar</option>
                                <option value="Malawi">Malawi</option>
                                <option value="Malaysia">Malaysia</option>
                                <option value="Maldives">Maldives</option>
                                <option value="Mali">Mali</option>
                                <option value="Malta">Malta</option>
                                <option value="Marshall Islands">Marshall Islands</option>
                                <option value="Mauritania">Mauritania</option>
                                <option value="Mauritius">Mauritius</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Micronesia">Micronesia</option>
                                <option value="Moldova">Moldova</option>
                                <option value="Monaco">Monaco</option>
                                <option value="Mongolia">Mongolia</option>
                                <option value="Montenegro">Montenegro</option>
                                <option value="Morocco">Morocco</option>
                                <option value="Mozambique">Mozambique</option>
                                <option value="Myanmar">Myanmar</option>
                                <option value="Namibia">Namibia</option>
                                <option value="Nauru">Nauru</option>
                                <option value="Nepal">Nepal</option>
                                <option value="Netherlands">Netherlands</option>
                                <option value="New Zealand">New Zealand</option>
                                <option value="Nicaragua">Nicaragua</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="North Macedonia">North Macedonia</option>
                                <option value="Norway">Norway</option>
                                <option value="Oman">Oman</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Palau">Palau</option>
                                <option value="Panama">Panama</option>
                                <option value="Papua New Guinea">Papua New Guinea</option>
                                <option value="Paraguay">Paraguay</option>
                                <option value="Peru">Peru</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Poland">Poland</option>
                                <option value="Portugal">Portugal</option>
                                <option value="Qatar">Qatar</option>
                                <option value="Romania">Romania</option>
                                <option value="Russia">Russia</option>
                                <option value="Rwanda">Rwanda</option>
                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                <option value="Saint Lucia">Saint Lucia</option>
                                <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                <option value="Samoa">Samoa</option>
                                <option value="San Marino">San Marino</option>
                                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="Senegal">Senegal</option>
                                <option value="Serbia">Serbia</option>
                                <option value="Seychelles">Seychelles</option>
                                <option value="Sierra Leone">Sierra Leone</option>
                                <option value="Singapore">Singapore</option>
                                <option value="Slovakia">Slovakia</option>
                                <option value="Slovenia">Slovenia</option>
                                <option value="Solomon Islands">Solomon Islands</option>
                                <option value="Somalia">Somalia</option>
                                <option value="South Africa">South Africa</option>
                                <option value="South Sudan">South Sudan</option>
                                <option value="Spain">Spain</option>
                                <option value="Sri Lanka">Sri Lanka</option>
                                <option value="Sudan">Sudan</option>
                                <option value="Suriname">Suriname</option>
                                <option value="Sweden">Sweden</option>
                                <option value="Switzerland">Switzerland</option>
                                <option value="Syria">Syria</option>
                                <option value="Taiwan">Taiwan</option>
                                <option value="Tajikistan">Tajikistan</option>
                                <option value="Tanzania">Tanzania</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Timor-Leste">Timor-Leste</option>
                                <option value="Togo">Togo</option>
                                <option value="Tonga">Tonga</option>
                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                <option value="Tunisia">Tunisia</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Turkmenistan">Turkmenistan</option>
                                <option value="Tuvalu">Tuvalu</option>
                                <option value="Uganda">Uganda</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="United States">United States</option>
                                <option value="Uruguay">Uruguay</option>
                                <option value="Uzbekistan">Uzbekistan</option>
                                <option value="Vanuatu">Vanuatu</option>
                                <option value="Vatican City">Vatican City</option>
                                <option value="Venezuela">Venezuela</option>
                                <option value="Vietnam">Vietnam</option>
                                <option value="Yemen">Yemen</option>
                                <option value="Zambia">Zambia</option>
                                <option value="Zimbabwe">Zimbabwe</option>
                            </select>
                        </div>
                    </div>
                </div>

                <hr class="separator">

                <p class="legal">
                    The <a href="#">Adobe family of companies</a> may keep me informed with <a href="#">personalized</a> emails about products and services. See our <a href="#">Privacy Policy</a> for more details or to opt-out at any time.
                </p>

                <div class="check-row">
                    <input type="checkbox" id="contact-email" name="contact_email" value="1" checked>
                    <label for="contact-email">Please contact me via email</label>
                </div>

                <p class="legal">
                    By clicking Create account, I agree that I have read and accepted the <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.
                </p>

                <button type="submit" class="btn-continue">Create account</button>
            </form>
        </div>
    </main>

    <footer class="page-footer">
        <span>Copyright &copy; <?php echo e(date('Y')); ?> Adobe. All rights reserved.</span>
        <span class="page-footer-sep">|</span>
        <a href="#">Terms of Use</a>
        <span class="page-footer-sep">|</span>
        <a href="#">Cookie preferences</a>
        <span class="page-footer-sep">|</span>
        <a href="#">Privacy</a>
        <span class="page-footer-sep">|</span>
        <a href="#">Do not sell or share my personal information</a>
    </footer>

</body>
</html><?php /**PATH C:\semester2\SBD\TUBES\behance_sbd\resources\views/auth/register2.blade.php ENDPATH**/ ?>