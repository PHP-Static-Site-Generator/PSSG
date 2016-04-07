＃ 用意されているドライバー

## Smarty ドライバー
テンプレートエンジン[Smarty](http://www.smarty.net/download)を使って、テンプレートをコンパイルします。

 * ソース拡張子
  * .tpl
 * コンパイル後拡張子
   * .html

## Smarty + YAMLドライバー
テンプレートエンジン[Smarty](http://www.smarty.net/download)を使って、テンプレートをコンパイルするところは、
Smarty ドライバーと同じですが、ymlファイルから、テンプレートに変数を渡すことができます。

.tpl.ymlは以下のフォーマットで記述します。

~~~~~~~~~~~~~~~~~~~~~~~~~~

# 実際のテンプレートファイル
file_name: index.tpl

# 渡す変数
page_variables:
  header_title: 'Hello PSSG World.'

~~~~~~~~~~~~~~~~~~~~~~~~~~

page_variablesは、`{%$page.header_title%}`のように参照できます。

 * ソース拡張子
  * .tpl.yml
 * コンパイル後拡張子
   * .html

## SCSSドライバー
[Sass(SCSS)](http://sass-lang.com/)をコンパイルします。

 * ソース拡張子
  * .scss
 * コンパイル後拡張子
   * .css

## TypeScriptドライバー
[TypeScript](https://www.typescriptlang.org/)をコンパイルします。

※TypeScriptドライバーを使用するには、別途

* [NodeJs](https://nodejs.org/en/download/)
* [TypeScript](https://www.typescriptlang.org/index.html#download-links)

のインストールが必要です。

 * ソース拡張子
  * .ts
 * コンパイル後拡張子
   * .js

