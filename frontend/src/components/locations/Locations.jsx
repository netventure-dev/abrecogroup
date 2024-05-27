import React from 'react';
import { Link } from "react-router-dom";
import './locations.css';
import India from "../../images/india.webp";
import UAE from "../../images/uae.webp";
import Australia from "../../images/australia.webp";
import Dots from "../../images/footer-dots.webp";
import { IoLocationSharp } from "react-icons/io5";

const Locations = () => {
    return (
        <section className='pageTitle'>
            <div className='container'>
                <div className='data'>
                    <img src={Dots} alt="" />
                    <p>We are at</p>
                    <h2><span>OFFICE</span> LOCATIONS</h2>
                </div>
                
                <div className='locationsBoxes'>
                    <div className='item'>
                        <div>
                            <img src={India} alt="" />
                        </div>
                        <h5><IoLocationSharp />INDIA</h5>
                        <Link to="#">Link</Link>
                    </div>
                    <div className='item'>
                        <div>
                            <img src={UAE} alt="" />
                        </div>
                        <h5><IoLocationSharp />UAE</h5>
                        <Link to="#">Link</Link>
                    </div>
                    <div className='item'>
                        <div>
                            <img src={Australia} alt="" />
                        </div>
                        <h5><IoLocationSharp />AUSTRALIA</h5>
                        <Link to="#">Link</Link>
                    </div>
                </div>
            </div>
        </section>
    )
}

export default Locations