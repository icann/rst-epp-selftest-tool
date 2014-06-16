Purpose
=======
The purpose of the EPP Selftest Tool is to help gTLD applicants prepare for
[Pre-Delegation Testing]( http://newgtlds.icann.org/en/applicants/pdt) (PDT) by
clarifying the transformation from input XML to submitted EPP commands.

Scope
=====
While the EPP Selftest Tool _does_ send actual EPP requests and _does_ report
the EPP responses, it _does not_ verify the the correctness of the responses.
Neither does it verify the pre- and post-conditions listed in the PDT EPP test
case specifications.

Disclaimer
----------
The EPP Selftest Tool and the actual EPP testing under PDT are not equal.
There is no guarantee that successfully running the EPP Selftest Tool means
that the same EPP system will pass the EPP testing under PDT. For example, the
parts of EPP tests under PDT that include DNS or Whois lookups are not included
in the EPP Selftest Tool. For a complete reference of the EPP tests under PDT
see the PDT EPP documents.

Version history
===============
 * v1.0.0 - Unpublished internal version
 * v2.0.0 - Initial public release (2013-09-27)
 * v2.1.0 - SNI support, clean-up, bug fixes (2014-03-13)

References
==========
The [Pre-Delegation Testing]( http://newgtlds.icann.org/en/applicants/pdt)
microsite hosts the following documents relevant to the EPP Selftest Tool:

 * The PDT\_EPP\_TC document, within the PDT Test Specifications zip,
   specifies the test cases that the EPP Selftest Tool partially implements.
 * The `pdtepp.xml` file, within the PDT Input Data Templates zip, is a
   template for the input data XML file.
 * The EPP test section of the PDT Input Data Instructions document describes
   how to fill in the input data XML template.

Specification compatibility matrix
----------------------------------
Refer to this compatibility matrix when deciding which version of EPP Selftest
Tool to use.

<table>
<tr><th>EPP Selftest Tool version</th><th>PDT Input Data Templates</th><th>PDT Test Specifications</th></tr>
<tr><td>v2.0.0</td><td>v.2.2</td><td>v.2.2</td></tr>
<tr><td>v2.1.0</td><td>v.2.3<sup>1</sup></td><td>v.2.3</td></tr>
</table>

<sup>1</sup> For SNI-support, the `pdtepp.xsd` of the PDT Input Data Templates
zip needs to be replaced with the `pdtepp.xsd` supplied with the
EPP-Selftest-Tool. No replacement for the `pdtepp.rnc` of the PDT Input Data
Templates zip is provided.

Licensing
=========
The entire source code is [this license]( LICENSE) except ireg
which is [LGPL 2.1]( LICENSE-LGPL-2.1), Client.php which is [GPL 2.0](
LICENSE-GPL-2.0) and parseIniFile.php which is [Creative Commons Attribution](
LICENSE-CC-BY). Refer to the respective files for copyright ownership.

Dependencies
============
 * Ubuntu 12.04
 * Perl 5.14
   * Config::IniFiles
   * DateTime
   * List::MoreUtils
   * XML::LibXML
   * XML::Simple
 * PHP 5.3
   * PEAR

Installation
============
Clone the project repository and choose version according to the specification
compatibility matrix.

    $> git clone https://github.com/dotse/EPP-Selftest-Tool.git <installdir>
    $> cd <installdir>
    $> git checkout <version>

`<installdir>` is assumed to be in the PATH in code examples throughout the
rest of this document.

Basic usage
===========
Working directory setup
-----------------------
 1. Create a new directory `<workdir>`
 2. Create a log directory `<workdir>/log`
 3. Extract the `pdtepp.xml` template file into `<workdir>`
 4. Fill in the `pdtepp.xml` template file according to the PDT Input Data
    Instructions and PDT\_EPP\_TC documents

`<workdir>` is assumed to be the current working directory in code examples
throughout the basic usage section.

Input data validation
---------------------
Validate the input data and convert it to the intermediate format used by `epp-test`:

    $> epp-convert --zone <TLD>

`epp-convert` reads `pdtepp.xml` as input.  As output it writes `config.ini` and
either writes or deletes `cert.pem` depending on whether or not the input file
contains a client certificate for connecting to the EPP server.

The `--zone` parameter is used to sanity-check the domain names used in the
input data.

Test case selection
-------------------
List the names of all available test cases:

    $> epp-test --list

Test case execution
-------------------
Run a test case using this command:

    $> epp-test --case <testcase>

When called with the `--case` parameter, the `epp-test` command executes the
EPP transactions determined by the `--case` argument and the contents of the
`config.ini` file.  The response code of each transaction is printed to STDOUT
and a more detailed log is written to `log/<testcase>.log`.

NOTE: Test cases may consume test data, so in order to run a test case again
the test data needs to be reset or new data needs be supplied.

Advanced usage
==============
The basic usage described above can be adapted to other settings by using
additional command line parameters.  For details please refer to the usage
information of the respective commands.

    $> epp-convert --help
    $> epp-test --help
