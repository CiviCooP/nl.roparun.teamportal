# nl.roparun.teamportal

This extension contains functionality for the team portal. 
The team portal is a separate website on which team captains could login and manage their team.
The team portal is connected to CiviCRM with the CiviMRF module and this module provides API's for that 
connection.  

Why not use the [nl.roparun.api](https://github.com/CiviCooP/nl.roparun.api) extension? 
Because the api's provided by that extension are tightly coupled to the public website and to the donation page.  
And also because it is easier to implement the API's for the portal as Get actions.

The extension is licensed under [AGPL-3.0](LICENSE.txt).

## Usage

This extension does not do anything in particilair in CiviCRM it only provides APIs for the team portal.

## Provided API's

* _PortalTeamCaptain.get_ Gets a list with the teamcaptains. [Docmentation](docs/api/TeamPortalCaptains.md)
* _PortalTeamMember.get_ gets a list with team members. 

## Requirements

* PHP v5.6+
* CiviCRM > 4.7
* nl.roparun.generic

## Installation (CLI, Zip)

Sysadmins and developers may download the `.zip` file for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
cd <extension-dir>
cv dl nl.roparun.teamportal@https://github.com/CiviCooP/nl.roparun.teamportal/archive/master.zip
```

## Installation (CLI, Git)

Sysadmins and developers may clone the [Git](https://en.wikipedia.org/wiki/Git) repo for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
git clone https://github.com/FIXME/nl.roparun.teamportal.git
cv en teamportal
```

## Known Issues

(* FIXME *)
