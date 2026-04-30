<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an account | Behance</title>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:ital,wght@0,300;0,400;0,600;0,700;0,900;1,400&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --blue: #1473e6;
            --blue-hover: #0d66d0;
            --text-dark: #2c2c2c;
            --text-mid: #4b4b4b;
            --text-light: #6e6e6e;
            --border: #d3d3d3;
            --bg-white: #ffffff;
            --font: 'Source Sans 3', 'Adobe Clean', sans-serif;
        }

        html, body {
            height: 100%;
            font-family: var(--font);
            overflow: hidden;
        }

        /* Background */
        .bg {
            position: fixed;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1501854140801-50d01698950b?q=80&w=2075&auto=format&fit=crop') no-repeat center center / cover;
            filter: brightness(0.72) saturate(0.85) sepia(0.18);
            z-index: 0;
        }

        /* Layout wrapper */
        .layout {
            position: relative;
            z-index: 1;
            display: flex;
            height: 100vh;
            flex-direction: row;
        }

        /* Left side - logo */
        .left {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
            color: #fff;
        }

        .brand-icon {
            width: 48px;
            height: 48px;
            background: #000;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            font-weight: 900;
            color: #fff;
            letter-spacing: -1px;
            font-family: var(--font);
        }

        .brand-name {
            font-size: 30px;
            font-weight: 700;
            letter-spacing: -0.3px;
            color: #fff;
        }

        /* Right side - form panel */
        .right {
            width: 480px;
            min-width: 480px;
            background: var(--bg-white);
            height: 100vh;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            padding: 52px 52px 40px 52px;
        }

        .right::-webkit-scrollbar { width: 4px; }
        .right::-webkit-scrollbar-thumb { background: #ccc; border-radius: 4px; }

        /* Step label */
        .step-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-light);
            margin-bottom: 8px;
            letter-spacing: 0.02em;
        }

        /* Title */
        h1 {
            font-size: 34px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 14px;
            line-height: 1.1;
        }

        /* Sign in link */
        .signin-row {
            font-size: 14px;
            color: var(--text-mid);
            margin-bottom: 28px;
        }
        .signin-row a {
            color: var(--blue);
            text-decoration: none;
            font-weight: 600;
        }
        .signin-row a:hover { text-decoration: underline; }

        /* Form */
        form { flex: 1; }

        .row-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 20px;
        }

        .field {
            margin-bottom: 20px;
        }

        .field label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 6px;
        }

        .field label .info-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 14px;
            height: 14px;
            background: var(--blue);
            color: #fff;
            border-radius: 50%;
            font-size: 9px;
            font-weight: 700;
            margin-left: 4px;
            vertical-align: middle;
            cursor: default;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            height: 38px;
            padding: 0 10px;
            border: 1px solid var(--border);
            border-radius: 4px;
            font-size: 14px;
            font-family: var(--font);
            color: var(--text-dark);
            background: #fff;
            outline: none;
            appearance: none;
            -webkit-appearance: none;
            transition: border-color 0.15s;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 2px rgba(20,115,230,0.15);
        }

        /* Custom select wrapper */
        .select-wrap {
            position: relative;
        }
        .select-wrap::after {
            content: '';
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 5px solid var(--text-mid);
            pointer-events: none;
        }
        .select-wrap select {
            padding-right: 30px;
        }

        /* Country/Region inline layout */
        .country-row {
            display: flex;
            align-items: center;
            gap: 0;
        }
        .country-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-dark);
            white-space: nowrap;
            margin-right: 10px;
        }
        .country-row .select-wrap {
            flex: 1;
        }
        .country-row select {
            border: none;
            border-bottom: 1px solid var(--border);
            border-radius: 0;
            background: transparent;
            padding-left: 0;
            font-size: 14px;
            color: var(--text-dark);
        }
        .country-row select:focus {
            border-color: var(--blue);
            box-shadow: none;
        }

        /* DOB row */
        .dob-row {
            display: grid;
            grid-template-columns: 3fr 2fr;
            gap: 12px;
        }

        /* Separator line */
        .separator {
            border: none;
            border-top: 1px solid #e8e8e8;
            margin: 20px 0 18px 0;
        }

        /* Legal text */
        .legal {
            font-size: 11.5px;
            color: var(--text-mid);
            line-height: 1.55;
            margin-bottom: 14px;
        }
        .legal a {
            color: var(--text-dark);
            text-decoration: underline;
        }
        .legal a:hover { color: var(--blue); }

        /* Checkbox */
        .check-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 18px;
        }
        .check-row input[type="checkbox"] {
            width: 14px;
            height: 14px;
            accent-color: var(--blue);
            cursor: pointer;
            flex-shrink: 0;
            border: 1px solid var(--border);
        }
        .check-row label {
            font-size: 13px;
            color: var(--text-dark);
            cursor: pointer;
        }

        /* Submit button */
        .btn-row {
            display: flex;
            justify-content: flex-end;
            margin-top: 8px;
        }

        .btn-create {
            background: var(--blue);
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 10px 24px;
            font-size: 14px;
            font-weight: 700;
            font-family: var(--font);
            cursor: pointer;
            transition: background 0.15s;
            letter-spacing: 0.01em;
        }
        .btn-create:hover { background: var(--blue-hover); }

        /* Footer */
        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(255,255,255,0.96);
            border-top: 1px solid #e0e0e0;
            padding: 11px 32px;
            font-size: 11px;
            color: var(--text-light);
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 10;
        }

        footer .footer-links {
            display: flex;
            gap: 18px;
            flex-wrap: wrap;
        }

        footer a {
            color: var(--text-light);
            text-decoration: none;
        }
        footer a:hover { text-decoration: underline; }

        /* Give bottom space so footer doesn't overlap form */
        .right { padding-bottom: 60px; }
    </style>
</head>
<body>

<div class="bg"></div>

<div class="layout">
    <!-- Left: Branding -->
    <div class="left">
        <div class="brand">
            <div class="brand-icon">Be</div>
            <span class="brand-name">Behance</span>
        </div>
    </div>

    <!-- Right: Form -->
    <div class="right">
        <p class="step-label">Step 2 of 2</p>
        <h1>Create an account</h1>
        <p class="signin-row">Already have an account? <a href="#">Sign in</a></p>

        <form>
            <!-- First & Last Name -->
            <div class="row-2">
                <div class="field">
                    <label>First name</label>
                    <input type="text" autocomplete="given-name">
                </div>
                <div class="field">
                    <label>Last name</label>
                    <input type="text" autocomplete="family-name">
                </div>
            </div>

            <!-- Date of Birth -->
            <div class="field">
                <label>Date of birth <span class="info-btn">i</span></label>
                <div class="dob-row">
                    <div class="select-wrap">
                        <select>
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
                    <input type="number" placeholder="Year" min="1900" max="2024">
                </div>
            </div>

            <!-- Country / Region -->
            <div class="field" style="margin-bottom: 24px;">
                <div class="country-row">
                    <span class="country-label">Country/Region</span>
                    <div class="select-wrap">
                        <select>
                            <option>Afghanistan</option>
                            <option>Albania</option>
                            <option>Algeria</option>
                            <option>Andorra</option>
                            <option>Angola</option>
                            <option>Antigua and Barbuda</option>
                            <option>Argentina</option>
                            <option>Armenia</option>
                            <option>Australia</option>
                            <option>Austria</option>
                            <option>Azerbaijan</option>
                            <option>Bahamas</option>
                            <option>Bahrain</option>
                            <option>Bangladesh</option>
                            <option>Barbados</option>
                            <option>Belarus</option>
                            <option>Belgium</option>
                            <option>Belize</option>
                            <option>Benin</option>
                            <option>Bhutan</option>
                            <option>Bolivia</option>
                            <option>Bosnia and Herzegovina</option>
                            <option>Botswana</option>
                            <option>Brazil</option>
                            <option>Brunei</option>
                            <option>Bulgaria</option>
                            <option>Burkina Faso</option>
                            <option>Burundi</option>
                            <option>Cabo Verde</option>
                            <option>Cambodia</option>
                            <option>Cameroon</option>
                            <option>Canada</option>
                            <option>Central African Republic</option>
                            <option>Chad</option>
                            <option>Chile</option>
                            <option>China</option>
                            <option>Colombia</option>
                            <option>Comoros</option>
                            <option>Congo (Congo-Brazzaville)</option>
                            <option>Congo (DRC)</option>
                            <option>Costa Rica</option>
                            <option>Croatia</option>
                            <option>Cuba</option>
                            <option>Cyprus</option>
                            <option>Czech Republic</option>
                            <option>Denmark</option>
                            <option>Djibouti</option>
                            <option>Dominica</option>
                            <option>Dominican Republic</option>
                            <option>Ecuador</option>
                            <option>Egypt</option>
                            <option>El Salvador</option>
                            <option>Equatorial Guinea</option>
                            <option>Eritrea</option>
                            <option>Estonia</option>
                            <option>Eswatini</option>
                            <option>Ethiopia</option>
                            <option>Fiji</option>
                            <option>Finland</option>
                            <option>France</option>
                            <option>Gabon</option>
                            <option>Gambia</option>
                            <option>Georgia</option>
                            <option>Germany</option>
                            <option>Ghana</option>
                            <option>Greece</option>
                            <option>Grenada</option>
                            <option>Guatemala</option>
                            <option>Guinea</option>
                            <option>Guinea-Bissau</option>
                            <option>Guyana</option>
                            <option>Haiti</option>
                            <option>Honduras</option>
                            <option>Hungary</option>
                            <option>Iceland</option>
                            <option selected>Indonesia</option>
                            <option>Iran</option>
                            <option>Iraq</option>
                            <option>Ireland</option>
                            <option>Israel</option>
                            <option>Italy</option>
                            <option>Jamaica</option>
                            <option>Japan</option>
                            <option>Jordan</option>
                            <option>Kazakhstan</option>
                            <option>Kenya</option>
                            <option>Kiribati</option>
                            <option>Korea, North</option>
                            <option>Korea, South</option>
                            <option>Kosovo</option>
                            <option>Kuwait</option>
                            <option>Kyrgyzstan</option>
                            <option>Laos</option>
                            <option>Latvia</option>
                            <option>Lebanon</option>
                            <option>Lesotho</option>
                            <option>Liberia</option>
                            <option>Libya</option>
                            <option>Liechtenstein</option>
                            <option>Lithuania</option>
                            <option>Luxembourg</option>
                            <option>Madagascar</option>
                            <option>Malawi</option>
                            <option>Malaysia</option>
                            <option>Maldives</option>
                            <option>Mali</option>
                            <option>Malta</option>
                            <option>Marshall Islands</option>
                            <option>Mauritania</option>
                            <option>Mauritius</option>
                            <option>Mexico</option>
                            <option>Micronesia</option>
                            <option>Moldova</option>
                            <option>Monaco</option>
                            <option>Mongolia</option>
                            <option>Montenegro</option>
                            <option>Morocco</option>
                            <option>Mozambique</option>
                            <option>Myanmar</option>
                            <option>Namibia</option>
                            <option>Nauru</option>
                            <option>Nepal</option>
                            <option>Netherlands</option>
                            <option>New Zealand</option>
                            <option>Nicaragua</option>
                            <option>Niger</option>
                            <option>Nigeria</option>
                            <option>North Macedonia</option>
                            <option>Norway</option>
                            <option>Oman</option>
                            <option>Pakistan</option>
                            <option>Palau</option>
                            <option>Panama</option>
                            <option>Papua New Guinea</option>
                            <option>Paraguay</option>
                            <option>Peru</option>
                            <option>Philippines</option>
                            <option>Poland</option>
                            <option>Portugal</option>
                            <option>Qatar</option>
                            <option>Romania</option>
                            <option>Russia</option>
                            <option>Rwanda</option>
                            <option>Saint Kitts and Nevis</option>
                            <option>Saint Lucia</option>
                            <option>Saint Vincent and the Grenadines</option>
                            <option>Samoa</option>
                            <option>San Marino</option>
                            <option>Sao Tome and Principe</option>
                            <option>Saudi Arabia</option>
                            <option>Senegal</option>
                            <option>Serbia</option>
                            <option>Seychelles</option>
                            <option>Sierra Leone</option>
                            <option>Singapore</option>
                            <option>Slovakia</option>
                            <option>Slovenia</option>
                            <option>Solomon Islands</option>
                            <option>Somalia</option>
                            <option>South Africa</option>
                            <option>South Sudan</option>
                            <option>Spain</option>
                            <option>Sri Lanka</option>
                            <option>Sudan</option>
                            <option>Suriname</option>
                            <option>Sweden</option>
                            <option>Switzerland</option>
                            <option>Syria</option>
                            <option>Taiwan</option>
                            <option>Tajikistan</option>
                            <option>Tanzania</option>
                            <option>Thailand</option>
                            <option>Timor-Leste</option>
                            <option>Togo</option>
                            <option>Tonga</option>
                            <option>Trinidad and Tobago</option>
                            <option>Tunisia</option>
                            <option>Turkey</option>
                            <option>Turkmenistan</option>
                            <option>Tuvalu</option>
                            <option>Uganda</option>
                            <option>Ukraine</option>
                            <option>United Arab Emirates</option>
                            <option>United Kingdom</option>
                            <option>United States</option>
                            <option>Uruguay</option>
                            <option>Uzbekistan</option>
                            <option>Vanuatu</option>
                            <option>Vatican City</option>
                            <option>Venezuela</option>
                            <option>Vietnam</option>
                            <option>Yemen</option>
                            <option>Zambia</option>
                            <option>Zimbabwe</option>
                        </select>
                    </div>
                </div>
            </div>

            <hr class="separator">

            <!-- Legal text 1 -->
            <p class="legal">
                The <a href="#">Adobe family of companies</a> may keep me informed with <a href="#">personalized</a> emails about products and services. See our <a href="#">Privacy Policy</a> for more details or to opt-out at any time.
            </p>

            <!-- Checkbox -->
            <div class="check-row">
                <input type="checkbox" id="contact-email" checked>
                <label for="contact-email">Please contact me via email</label>
            </div>

            <!-- Legal text 2 -->
            <p class="legal">
                By clicking Create account, I agree that I have read and accepted the <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.
            </p>

            <!-- Submit -->
            <div class="btn-row">
                <button type="submit" class="btn-create">Create account</button>
            </div>
        </form>
    </div>
</div>

<!-- Footer -->
<footer>
    <span>Copyright &copy; 2025 Adobe. All rights reserved.</span>
    <div class="footer-links">
        <a href="#">Terms of Use</a>
        <a href="#">Cookie preferences</a>
        <a href="#">Privacy</a>
        <a href="#">Do not sell or share my personal information</a>
    </div>
</footer>

</body>
</html>