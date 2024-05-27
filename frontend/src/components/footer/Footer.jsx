import React from 'react';
import { Link } from "react-router-dom";
import './footer.css';
import Dots from "../../images/footer-dots.webp";
import Phone from "../../images/phone.webp";
import Email from "../../images/email.webp";
import { FaFacebook, FaInstagram } from 'react-icons/fa';

const Footer = () => {
    return (
        <>
            <footer>
                <div className='container'>
                    <div className='rowData'>
                        <div className='contact'>
                            <img src={Dots} alt="" />
                            <span>Contact Us</span>
                            <h2><span>JOIN US ON THIS EXCITING JOURNEY!</span> TOGETHER, WE CAN BUILD A BETTER WORLD</h2>
                            <p>Street No: S401, Plot No. S30603, <br></br>Jebel Ali Free Zone South 3, Dubai, U.A.E</p>
                            <ul className='m-0'>
                                <li><img src={Phone} alt="" /><Link to="tel:+97148149000">+971 4814 9000</Link></li>
                                <li><img src={Email} alt="" /><Link to="mailto:info@abrecogroup.com">info@abrecogroup.com</Link></li>
                            </ul>
                        </div>
                        <div className='form'>
                            <div class="form-container">
                                <div class="form-group">
                                    <input className='form-control' type="text" placeholder=" " id="name" />
                                    <label for="name">Your Name</label>
                                </div>
                                <div class="form-group">
                                    <input className='form-control' type="email" placeholder=" " id="email" />
                                    <label for="email">Email Address</label>
                                </div>
                                <div class="form-group">
                                    <input className='form-control' type="text" placeholder=" " id="subject" />
                                    <label for="subject">Subject</label>
                                </div>
                                <div class="form-group">
                                    <textarea className='form-control' placeholder='' id='message' ></textarea>
                                    <label for="message">Your Message</label>
                                </div>
                                <button class="submit-button" type="submit">JOIN THE ABRECO FAMILY TODAY!</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div className='container-fluid'>
                    <div className='rowData'>
                        <ul className='extraLinks'>
                            <li><Link to="#">Terms and Conditions</Link></li>
                            <li><Link to="#">Privacy Policy</Link></li>
                        </ul>
                        <ul className='socialLinks'>
                            <li><Link to="#"><FaFacebook /></Link></li>
                            <li><Link to="#"><FaInstagram /></Link></li>
                        </ul>
                        <p>All Rights Reserved | Copyright &copy; Abreco Group 2024 | Digitally Empowered By <Link to="https://www.netventure.in/" target="_blank">NetVenture</Link></p>
                    </div>
                </div>
            </footer>
        </>
    )
}

export default Footer