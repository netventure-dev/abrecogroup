import React from 'react';
import { Link } from "react-router-dom";
import './news.css';
import India from "../../images/india.webp";
import UAE from "../../images/uae.webp";
import Australia from "../../images/australia.webp";
import Dots from "../../images/footer-dots.webp";

const News = () => {
  return (
    <section className='pageTitle news'>
        <div className='container'>
            <div className='data'>
                <img src={Dots} alt="" />
                <p>Recent Updates</p>
                <h2>OUR <span>NEWS</span></h2>
            </div>
            
            <div className='newsBoxes'>
                <div className='item'>
                    <div>
                        <img src={India} alt="" />
                    </div>
                    <h5>Now Part of <span>THE NEPTUNE CARGO NETWORK</span></h5>
                    <Link to="#">Link</Link>
                </div>
                <div className='item'>
                    <div>
                        <img src={UAE} alt="" />
                    </div>
                    <h5><span>LUCA SOCCER HUB: </span>Abreco Group</h5>
                    <Link to="#">Link</Link>
                </div>
                <div className='item'>
                    <div>
                        <img src={Australia} alt="" />
                    </div>
                    <h5><span>ISO CERTIFIED: </span>Abreco Freight Pvt. Ltd.</h5>
                    <Link to="#">Link</Link>
                </div>
            </div>

            <div className='allNews'>
                <Link to="#">All News</Link>
            </div>
        </div>
    </section>
  )
}

export default News