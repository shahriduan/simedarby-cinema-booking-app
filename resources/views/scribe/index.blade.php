<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Cinema Booking App API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .php-example code { display: none; }
                    body .content .javascript-example code { display: none; }
                    body .content .python-example code { display: none; }
            </style>


    <script src="{{ asset("/vendor/scribe/js/theme-default-5.11.0.js") }}"></script>

</head>

<body data-languages="[&quot;php&quot;,&quot;javascript&quot;,&quot;python&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="php">php</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                                            <button type="button" class="lang-button" data-language-name="python">python</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authentication" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authentication">
                    <a href="#authentication">Authentication</a>
                </li>
                                    <ul id="tocify-subheader-authentication" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="authentication-POSTapi-authenticate">
                                <a href="#authentication-POSTapi-authenticate">Login</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-GETapi-user">
                                <a href="#authentication-GETapi-user">User Profile</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-booking" class="tocify-header">
                <li class="tocify-item level-1" data-unique="booking">
                    <a href="#booking">Booking</a>
                </li>
                                    <ul id="tocify-subheader-booking" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="booking-POSTapi-booking-ticket">
                                <a href="#booking-POSTapi-booking-ticket">Book Ticket</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-cinema" class="tocify-header">
                <li class="tocify-item level-1" data-unique="cinema">
                    <a href="#cinema">Cinema</a>
                </li>
                                    <ul id="tocify-subheader-cinema" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="cinema-GETapi-areas">
                                <a href="#cinema-GETapi-areas">List Areas</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="cinema-GETapi-cinemas">
                                <a href="#cinema-GETapi-cinemas">List Cinemas</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-food-and-beverages" class="tocify-header">
                <li class="tocify-item level-1" data-unique="food-and-beverages">
                    <a href="#food-and-beverages">Food and Beverages</a>
                </li>
                                    <ul id="tocify-subheader-food-and-beverages" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="food-and-beverages-GETapi-fnb-menu">
                                <a href="#food-and-beverages-GETapi-fnb-menu">FnB Menu</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-movies" class="tocify-header">
                <li class="tocify-item level-1" data-unique="movies">
                    <a href="#movies">Movies</a>
                </li>
                                    <ul id="tocify-subheader-movies" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="movies-GETapi-movies">
                                <a href="#movies-GETapi-movies">List Movies</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="movies-GETapi-movies--movie_id-">
                                <a href="#movies-GETapi-movies--movie_id-">Movie Details</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: June 27, 2026</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<aside>
    <strong>Base URL</strong>: <code>http://127.0.0.1:8000</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>To authenticate requests, include an <strong><code>Authorization</code></strong> header with the value <strong><code>"Bearer 35|5IV46RkmdNU9igP6jZuGYgvtOT4lS1qsKaEqtr6B589fb999"</code></strong>.</p>
<p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation below.</p>
<p>You can retrieve your token by use Login API.</p>

        <h1 id="authentication">Authentication</h1>

    

                                <h2 id="authentication-POSTapi-authenticate">Login</h2>

<p>
</p>

<p>To get access token.</p>

<span id="example-requests-POSTapi-authenticate">
<blockquote>Example request:</blockquote>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/authenticate';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'email' =&gt; 'najmuddin@gmail.com',
            'password' =&gt; 'najmuddin@1',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/authenticate"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "najmuddin@gmail.com",
    "password": "najmuddin@1"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://127.0.0.1:8000/api/authenticate'
payload = {
    "email": "najmuddin@gmail.com",
    "password": "najmuddin@1"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-authenticate">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;message&quot;: &quot;OK&quot;,
    &quot;data&quot;: {
        &quot;token&quot;: &quot;6|8edWLXRg4dQp1lhMf7rEW30vB9Zb0c4IEUgRAnNge0d7f209&quot;,
        &quot;user&quot;: {
            &quot;first_name&quot;: &quot;Najmuddin&quot;,
            &quot;last_name&quot;: &quot;Razali&quot;,
            &quot;email&quot;: &quot;najmuddin@gmail.com&quot;
        }
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-authenticate" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-authenticate"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-authenticate"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-authenticate" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-authenticate">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-authenticate" data-method="POST"
      data-path="api/authenticate"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-authenticate', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/authenticate</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-authenticate"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-authenticate"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-authenticate"
               value="najmuddin@gmail.com"
               data-component="body">
    <br>
<p>User email. Example: <code>najmuddin@gmail.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-authenticate"
               value="najmuddin@1"
               data-component="body">
    <br>
<p>User password. Example: <code>najmuddin@1</code></p>
        </div>
        </form>

                    <h2 id="authentication-GETapi-user">User Profile</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-user">
<blockquote>Example request:</blockquote>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/user';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer 35|5IV46RkmdNU9igP6jZuGYgvtOT4lS1qsKaEqtr6B589fb999',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/user"
);

const headers = {
    "Authorization": "Bearer 35|5IV46RkmdNU9igP6jZuGYgvtOT4lS1qsKaEqtr6B589fb999",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://127.0.0.1:8000/api/user'
headers = {
  'Authorization': 'Bearer 35|5IV46RkmdNU9igP6jZuGYgvtOT4lS1qsKaEqtr6B589fb999',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-user">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;message&quot;: &quot;OK&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 2,
        &quot;first_name&quot;: &quot;Alex Goh&quot;,
        &quot;last_name&quot;: &quot;Kean Tiong&quot;,
        &quot;email&quot;: &quot;alex@gmail.com&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-user" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-user"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-user"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-user" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-user">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-user" data-method="GET"
      data-path="api/user"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-user', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/user</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-user"
               value="Bearer 35|5IV46RkmdNU9igP6jZuGYgvtOT4lS1qsKaEqtr6B589fb999"
               data-component="header">
    <br>
<p>Example: <code>Bearer 35|5IV46RkmdNU9igP6jZuGYgvtOT4lS1qsKaEqtr6B589fb999</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="booking">Booking</h1>

    

                                <h2 id="booking-POSTapi-booking-ticket">Book Ticket</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-booking-ticket">
<blockquote>Example request:</blockquote>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/booking/ticket';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer 35|5IV46RkmdNU9igP6jZuGYgvtOT4lS1qsKaEqtr6B589fb999',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'cinema_id' =&gt; 1,
            'movie_id' =&gt; 2,
            'showtime_slot' =&gt; '2026-06-07 09:20:00',
            'seats' =&gt; [
                'F4',
                'F5',
                'F6',
            ],
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/booking/ticket"
);

const headers = {
    "Authorization": "Bearer 35|5IV46RkmdNU9igP6jZuGYgvtOT4lS1qsKaEqtr6B589fb999",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "cinema_id": 1,
    "movie_id": 2,
    "showtime_slot": "2026-06-07 09:20:00",
    "seats": [
        "F4",
        "F5",
        "F6"
    ]
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://127.0.0.1:8000/api/booking/ticket'
payload = {
    "cinema_id": 1,
    "movie_id": 2,
    "showtime_slot": "2026-06-07 09:20:00",
    "seats": [
        "F4",
        "F5",
        "F6"
    ]
}
headers = {
  'Authorization': 'Bearer 35|5IV46RkmdNU9igP6jZuGYgvtOT4lS1qsKaEqtr6B589fb999',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-booking-ticket">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;message&quot;: &quot;OK&quot;,
    &quot;data&quot;: {
        &quot;booking&quot;: {
            &quot;booking_number&quot;: &quot;B260627143845&quot;,
            &quot;user&quot;: {
                &quot;id&quot;: 2,
                &quot;first_name&quot;: &quot;Alex Goh&quot;,
                &quot;last_name&quot;: &quot;Kean Tiong&quot;,
                &quot;email&quot;: &quot;alex@gmail.com&quot;
            },
            &quot;cinema_id&quot;: 1,
            &quot;movie_id&quot;: 3,
            &quot;movie_start_at&quot;: &quot;2026-06-28 09:20:00&quot;,
            &quot;movie_end_at&quot;: &quot;2026-06-28 11:22:00&quot;,
            &quot;total_selected_seat&quot;: 2,
            &quot;promo_code&quot;: null,
            &quot;total_ticket_price&quot;: &quot;30.00&quot;,
            &quot;fnb_total_price&quot;: &quot;0.00&quot;,
            &quot;service_charges&quot;: &quot;0.30&quot;,
            &quot;discount_price&quot;: &quot;0.00&quot;,
            &quot;grand_total_price&quot;: &quot;30.30&quot;,
            &quot;booking_status&quot;: &quot;Cart&quot;,
            &quot;cart_expired_at&quot;: &quot;2026-06-27 14:48:45&quot;
        },
        &quot;seat_lock_period&quot;: 10
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-booking-ticket" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-booking-ticket"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-booking-ticket"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-booking-ticket" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-booking-ticket">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-booking-ticket" data-method="POST"
      data-path="api/booking/ticket"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-booking-ticket', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/booking/ticket</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-booking-ticket"
               value="Bearer 35|5IV46RkmdNU9igP6jZuGYgvtOT4lS1qsKaEqtr6B589fb999"
               data-component="header">
    <br>
<p>Example: <code>Bearer 35|5IV46RkmdNU9igP6jZuGYgvtOT4lS1qsKaEqtr6B589fb999</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-booking-ticket"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-booking-ticket"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>cinema_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="cinema_id"                data-endpoint="POSTapi-booking-ticket"
               value="1"
               data-component="body">
    <br>
<p>Cinema ID. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>movie_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="movie_id"                data-endpoint="POSTapi-booking-ticket"
               value="2"
               data-component="body">
    <br>
<p>Movie ID. Example: <code>2</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>showtime_slot</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="showtime_slot"                data-endpoint="POSTapi-booking-ticket"
               value="2026-06-07 09:20:00"
               data-component="body">
    <br>
<p>Slot datetime. Example: <code>2026-06-07 09:20:00</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>seats</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="seats[0]"                data-endpoint="POSTapi-booking-ticket"
               data-component="body">
        <input type="text" style="display: none"
               name="seats[1]"                data-endpoint="POSTapi-booking-ticket"
               data-component="body">
    <br>
<p>Selected seats.</p>
        </div>
        </form>

                <h1 id="cinema">Cinema</h1>

    

                                <h2 id="cinema-GETapi-areas">List Areas</h2>

<p>
</p>



<span id="example-requests-GETapi-areas">
<blockquote>Example request:</blockquote>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/areas';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/areas"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://127.0.0.1:8000/api/areas'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-areas">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;message&quot;: &quot;OK&quot;,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Putrajaya&quot;
        },
        {
            &quot;id&quot;: 2,
            &quot;name&quot;: &quot;Subang Jaya&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-areas" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-areas"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-areas"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-areas" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-areas">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-areas" data-method="GET"
      data-path="api/areas"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-areas', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/areas</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-areas"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-areas"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="cinema-GETapi-cinemas">List Cinemas</h2>

<p>
</p>



<span id="example-requests-GETapi-cinemas">
<blockquote>Example request:</blockquote>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/cinemas';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'query' =&gt; [
            'area_id' =&gt; '1',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/cinemas"
);

const params = {
    "area_id": "1",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://127.0.0.1:8000/api/cinemas'
params = {
  'area_id': '1',
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers, params=params)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-cinemas">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;message&quot;: &quot;OK&quot;,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;GSC - IOI City Mall&quot;,
            &quot;area_id&quot;: 1
        },
        {
            &quot;id&quot;: 2,
            &quot;name&quot;: &quot;GSC - Subang Parade&quot;,
            &quot;area_id&quot;: 2
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-cinemas" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-cinemas"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-cinemas"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-cinemas" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-cinemas">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-cinemas" data-method="GET"
      data-path="api/cinemas"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-cinemas', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/cinemas</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-cinemas"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-cinemas"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>area_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="area_id"                data-endpoint="GETapi-cinemas"
               value="1"
               data-component="query">
    <br>
<p>Area ID. Example: <code>1</code></p>
            </div>
                </form>

                <h1 id="food-and-beverages">Food and Beverages</h1>

    

                                <h2 id="food-and-beverages-GETapi-fnb-menu">FnB Menu</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>List of food and beverages with category</p>

<span id="example-requests-GETapi-fnb-menu">
<blockquote>Example request:</blockquote>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/fnb/menu';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer 35|5IV46RkmdNU9igP6jZuGYgvtOT4lS1qsKaEqtr6B589fb999',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/fnb/menu"
);

const headers = {
    "Authorization": "Bearer 35|5IV46RkmdNU9igP6jZuGYgvtOT4lS1qsKaEqtr6B589fb999",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://127.0.0.1:8000/api/fnb/menu'
headers = {
  'Authorization': 'Bearer 35|5IV46RkmdNU9igP6jZuGYgvtOT4lS1qsKaEqtr6B589fb999',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-fnb-menu">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;message&quot;: &quot;OK&quot;,
    &quot;data&quot;: [
        {
            &quot;category&quot;: &quot;Combo&quot;,
            &quot;items&quot;: [
                {
                    &quot;name&quot;: &quot;Tasty Combo&quot;,
                    &quot;description&quot;: &quot;2 Shawarma, Pack of fries &amp; Pepsi&quot;,
                    &quot;unit_price&quot;: 28
                }
            ]
        },
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-fnb-menu" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-fnb-menu"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-fnb-menu"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-fnb-menu" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-fnb-menu">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-fnb-menu" data-method="GET"
      data-path="api/fnb/menu"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-fnb-menu', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/fnb/menu</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-fnb-menu"
               value="Bearer 35|5IV46RkmdNU9igP6jZuGYgvtOT4lS1qsKaEqtr6B589fb999"
               data-component="header">
    <br>
<p>Example: <code>Bearer 35|5IV46RkmdNU9igP6jZuGYgvtOT4lS1qsKaEqtr6B589fb999</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-fnb-menu"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-fnb-menu"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="movies">Movies</h1>

    

                                <h2 id="movies-GETapi-movies">List Movies</h2>

<p>
</p>



<span id="example-requests-GETapi-movies">
<blockquote>Example request:</blockquote>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/movies';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/movies"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://127.0.0.1:8000/api/movies'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-movies">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;message&quot;: &quot;OK&quot;,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 4,
            &quot;title&quot;: &quot;Masters Of The Universe&quot;,
            &quot;release_date&quot;: &quot;2026-06-04&quot;,
            &quot;classification&quot;: &quot;13&quot;,
            &quot;rating&quot;: &quot;3.3&quot;,
            &quot;total_rating_people&quot;: 46,
            &quot;genre&quot;: [
                &quot;Action&quot;
            ],
            &quot;synopsis&quot;: &quot;A young man on Earth discovers a fabulous secret legacy as the prince of an alien planet, and must recover a magic sword and return home to protect his kingdom.&quot;,
            &quot;director&quot;: &quot;Travis Knight&quot;,
            &quot;writers&quot;: &quot;Chris Butler, Aaron Nee, Adam Nee&quot;,
            &quot;poster_url&quot;: &quot;https://poster.gsc.com.my/2025/251117_MastersOfTheUniverse_big.jpg&quot;,
            &quot;trailer_url&quot;: &quot;https://youtu.be/Vf_5H3T8Y7Q?si=HOg0l0F5EeMOpMvG&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-movies" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-movies"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-movies"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-movies" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-movies">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-movies" data-method="GET"
      data-path="api/movies"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-movies', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/movies</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-movies"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-movies"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="movies-GETapi-movies--movie_id-">Movie Details</h2>

<p>
</p>

<p>This API include rating and reviews</p>

<span id="example-requests-GETapi-movies--movie_id-">
<blockquote>Example request:</blockquote>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/movies/1';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/movies/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://127.0.0.1:8000/api/movies/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-movies--movie_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;message&quot;: &quot;OK&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 4,
        &quot;title&quot;: &quot;Masters Of The Universe&quot;,
        &quot;release_date&quot;: &quot;2026-06-04&quot;,
        &quot;classification&quot;: &quot;13&quot;,
        &quot;rating&quot;: &quot;3.3&quot;,
        &quot;total_rating_people&quot;: 46,
        &quot;genre&quot;: [
            &quot;Action&quot;
        ],
        &quot;synopsis&quot;: &quot;A young man on Earth discovers a fabulous secret legacy as the prince of an alien planet, and must recover a magic sword and return home to protect his kingdom.&quot;,
        &quot;director&quot;: &quot;Travis Knight&quot;,
        &quot;writers&quot;: &quot;Chris Butler, Aaron Nee, Adam Nee&quot;,
        &quot;poster_url&quot;: &quot;https://poster.gsc.com.my/2025/251117_MastersOfTheUniverse_big.jpg&quot;,
        &quot;trailer_url&quot;: &quot;https://youtu.be/Vf_5H3T8Y7Q?si=HOg0l0F5EeMOpMvG&quot;,
        &quot;movie_reviews&quot;: [
            {
                &quot;id&quot;: 147,
                &quot;name&quot;: &quot;Rasammah a/l Mutahir&quot;,
                &quot;rating&quot;: 5,
                &quot;review_title&quot;: &quot;Good movie but pacing was a bit slow.&quot;,
                &quot;review_content&quot;: &quot;Perspiciatis modi corrupti qui qui omnis modi sit. Laborum odio commodi fugiat et iure recusandae. Ut rerum minima accusamus ut.&quot;
            }
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-movies--movie_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-movies--movie_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-movies--movie_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-movies--movie_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-movies--movie_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-movies--movie_id-" data-method="GET"
      data-path="api/movies/{movie_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-movies--movie_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/movies/{movie_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-movies--movie_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-movies--movie_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>movie_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="movie_id"                data-endpoint="GETapi-movies--movie_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the movie. Example: <code>1</code></p>
            </div>
                    </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="php">php</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                                                        <button type="button" class="lang-button" data-language-name="python">python</button>
                            </div>
            </div>
</div>
</body>
</html>
