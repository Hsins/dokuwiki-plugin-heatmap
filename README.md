<!-- badges -->
<div align="right">

  [![](https://img.shields.io/github/license/Hsins/dokuwiki-plugin-heatmap.svg?label=License&style=flat-square)](./LICENSE)

</div>

<!-- logo, title and description -->
<div align="center">

  <img src="https://github.com/user-attachments/assets/6e311c10-0644-4559-b5ea-10a432844135" alt="DokuWiki Plugin: Heatmap" height="150px" />

# DokuWiki Plugin: Heatmap

🧩 _DokuWiki plugin for showing heatmap of yearly pages with [Apache ECharts](https://echarts.apache.org/) visualization library._

[![Plugin Page](https://img.shields.io/badge/PLUGIN%20PAGE--f5edcc.svg?logo=read-the-docs&style=flat-square)](https://www.dokuwiki.org/plugin:heatmap)
[![](https://img.shields.io/badge/CHANGELOG--E08B32.svg?logo=git&style=flat-square)](./CHANGELOG.md)

</div>

## Installation

There're roughly different 3 methods to install an extension on your DokuWiki instance:

- **Method 01** — Search and install the plugin using the [Extension Manager](https://www.dokuwiki.org/plugin:extension).
- **Method 02** — Download the extension and unpack it into `<DOKUWIKI_DIR>/lib/plugins/heatmap` on your server.
- **Method 03** — Maintain and install with [DokuWiki Command Line Tools](https://www.dokuwiki.org/plugin:cli).

Example of installing with DokuWiki Command Line Tools:

``` bash
# Install KaTeX plugin via Git.
$ ./bin/gittool.php clone heatmap

# The same as clone, but install via download when no git source can be found.
$ ./bin/gittool.php install heatmap
```

## Usage

Default with current year and all namespaces:

```
<heatmap>
```

Given namespace and year:

```
<heatmap ns=blog year=2024>
```

## Sreenshots and Demo Sites

### Screenshots

<table>
<tr>
  <th> Normal </th>
  <th> Hover </th>
</tr>
<tr>
<td align="center">

![image](https://github.com/user-attachments/assets/0e1553f5-c89a-4e33-a7ee-9219420115db)
  
</td>
<td align="center">

![image](https://github.com/user-attachments/assets/91a0128a-0df8-4bd9-80bf-a66f61b0ba53)

</td>
</tr>

</table>

### Demo Sites

The following DokuWiki sites use the Heatmap plugin:

- [OSKI](https://wiki.hsins.eu/) : Hsins' personal wiki set up experimentally using DokuWiki.

> [!NOTE]
> If you're and using Heatmap plugin on your DokuWiki instance, feel free to add it to the list 😊.

## Contribution

This project exists thanks to all the people who contribute:

<a href="https://github.com/Hsins/dokuwiki-plugin-heatmap/graphs/contributors">
  <img src="https://contrib.rocks/image?repo=Hsins/dokuwiki-plugin-heatmap" />
</a>

## License

Licensed under the GPL-3.0 License, Copyright © 2024-present **H.-H. PENG (Hsins)**.

<div align="center">
  <sub>Assembled with ❤️ in Taiwan.</sub>
</div>