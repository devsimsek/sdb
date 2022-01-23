<div id="top"></div>

<!-- Shields -->
[![hits](https://hits.deltapapa.io/github/devsimsek/sdb.svg)](https://devsimsek.github.io/sdb)
[![Github All Releases](https://img.shields.io/github/downloads/devsimsek/sdb/total.svg)]()
[![GitHub license](https://img.shields.io/github/license/sdb/sdb.svg)](https://github.com/devsimsek/sdb/blob/master/LICENSE)
[![Maintenance](https://img.shields.io/badge/Maintained%3F-no-red.svg)](https://GitHub.com/devsimsek/sdb/graphs/commit-activity)
[![GitHub issues](https://img.shields.io/github/issues/devsimsek/sdb.svg)](https://GitHub.com/devsimsek/sdb/issues/)
[![Open Source](https://badges.frapsoft.com/os/v1/open-source.svg?v=103)](https://github.com/devsimsek/sdb)



<!-- Logo -->
<br />
<div align="center">
  <a href="https://github.com/devsimsek/sdb">
    <i style="font-size: 350%;color: white;-webkit-font-smoothing: antialiased;">smsk<b style="color: black;text-shadow: #fff 0 0 5px;">db</b></i>
  </a>

<h3 align="center">smskdb</h3>

  <p align="center">
    smskdb - A New Flat Json Database
    <br />
    <a href="https://github.com/devsimsek/smskdb"><strong>Explore the docs »</strong></a>
    <br />
    <br />
    <a href="https://github.com/devsimsek/smskdb/issues">Report Bug</a>
    ·
    <a href="https://github.com/devsimsek/smskdb/issues">Request Feature</a>
  </p>
</div>



<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
  </ol>
</details>



<!-- ABOUT THE PROJECT -->

## About The Project

Ever needed any flat database on your php project?

With smskdb you can create, edit and query flat database with smskdb class.

So why waiting? Get started now!

<p align="right">(<a href="#top">back to top</a>)</p>

### Built With

* [Php](https://php.net/)
* Json database

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- GETTING STARTED -->

## Getting Started

### Installation

You can install sdb using git or github cli

OS X & Linux & Windows (With Github CLI):

```sh
gh repo clone devsimsek/sdb
```

OS X & Linux & Windows (With Git):

```sh
git clone https://github.com/devsimsek/sdb.git
```

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- USAGE EXAMPLES -->

## Usage

Once you've installed smskdb successfully on your workspace you can start using your flat database.

Example Usage;

```php
<?php
require "Sdb.php";

$sdb = new Sdb("exampleDirectory", true);

// Create New Database
if ($sdb->create("example.sdb")) {
    // Load created database and access it by objects
    $sdb->load("example.sdb", SDB_READ_OBJ);
    // Set new data in database
    $sdb->set("test", array("is_success" => "true"));
    // Save updated records to database
    $sdb->save();
}
```

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- ROADMAP -->

## Roadmap

- [x] Optimizing code
- [ ] Create sql engine

See the [open issues](https://github.com/devsimsek/sdb/issues) for a full list of proposed features (and known issues).

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- CONTRIBUTING -->

## Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any
contributions you make are **greatly appreciated**.

If you have a suggestion that would make sdb better, please fork the repo and create a pull request. You can also
simply open an issue with the tag "enhancement". Don't forget to give the project a star! Thanks again!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- LICENSE -->

## License

Distributed under the MIT License. See `LICENSE` for more information.

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- CONTACT -->

## Contact

devsimsek - [@smskSoft](https://smsk.me) - mtnsmsk@smsk.ga

Project Link: [https://github.com/devsimsek/sdb](https://github.com/devsimsek/sdb)

<p align="right">(<a href="#top">back to top</a>)</p>
