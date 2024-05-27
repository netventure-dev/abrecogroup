import React from 'react';
import { Link } from "react-router-dom";

import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min';
import 'bootstrap-icons/font/bootstrap-icons.css';
import 'animate.css/animate.min.css';
import './navbar.css';

import Logo from "../../images/abreco-logo.webp";

const Navbar = () => {
  return (
    <nav id='site-nav' class="navbar navbar-expand-lg">
      <div class="container">
        <Link className='navbar-brand' to="/"><img src={Logo} /></Link>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav">
            <li class="nav-item"><Link className='nav-link' to="/">Home</Link></li>
            <li class="nav-item"><Link className='nav-link' to="/about-us">About Us</Link></li>
            <li class="nav-item"><Link className='nav-link' to="/brands">Brands</Link></li>
          </ul>
        </div>
      </div>
    </nav>
  )
}

export default Navbar