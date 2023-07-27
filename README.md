# Restful API Integration with Laravel Passport

Virtual Internship Experience (Investree) - Fullstack - Effel Zefanya Shuban

This is a project created to solve the 5th task of Investree's Fullstack Developer Virtual Internship Experience (VIX). Created by Effel Zefanya as his final project of the internship.

## Table of Contents
- [Overview](#overview)
- [My Process](#my-process)
    - [Built With](#built-with)
    - [What I Learned](#what-i-learned)
    - [Challenge I Encountered](#challenge-i-encountered)

## Overveiw
Goal: Building a REST API and OAuth token using the Laravel framework, as well as Laravel Passport.

## Process
- Set up the Laravel Passport for authenticating users using JWT (Json Web Token)
- Modify code based on the neccessary changes needed so the authentication can work fine.
- Create model for Articles and Categories. Alongside factory, migration and seeder for each models.
- Set the eloquent relations for each models
- Create API endpoints for registration and resource management (articles and categories)
- Modify route/api.php so the api can be accessed by users. But to manage the resource, the user has to authenticate themself.
- Assure the v1 prefix for the api has been set up correctly and works fine
- Create pagination for api data in baseController

### Built with
- PHP
- Laravel
- Passport
- XAMPP's myPHPadmin

### What I learned
- API is a middle layer used to connect front end and back end. API is used to promote maintainability, and scalability
- Laravel's passport can be used to help JWT authentication in restful API. By creating an access token, the token can be used by application to identify and authenticate users

### Challenges I encountered
- API integration with JWT authentication is a new thing I kind of struggle understand. Even though I've understand the overview of it, I haven't able to implement it in a code perfectly
- With the vast library composer provides and laravel can use, sometimes I find it hard to understand from which library/package my class or method is from. Changing codes sometimes takes a bit longer because I used the wrong package.
- Because JWT authentication doesn't work, I can't create tests for API resource management
