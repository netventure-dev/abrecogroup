import React, { useState } from 'react';
import './join.css';
import { Link } from 'react-router-dom';
import AliceCarousel from 'react-alice-carousel';
import 'react-alice-carousel/lib/alice-carousel.css';
import AnimatedComponent from '../AnimatedComponent';

import ReactSlidy from 'react-slidy';
import 'react-slidy/lib/index.scss'
import 'react-slidy/lib/styles.css'

import Dots from "../../images/careerDots.svg";
import JoinImg from "../../images/join.webp";
import Dots2 from "../../images/dots-3.webp";
import JoinLeft from "../../images/join-left.webp";
import JoinRight from "../../images/join-right.webp";

const items = [
    <div className="item" data-value="1"><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean pretium enim mauris, id posuere augue ullamcorper at. Nunc dignissim, purus quis lacinia pharetra, lorem odio volutpat velit,</small><a href="#">read more</a><b>01</b></div>,
    <div className="item" data-value="2"><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean pretium enim mauris, id posuere augue ullamcorper at. Nunc dignissim, purus quis lacinia pharetra, lorem odio volutpat velit,</small><a href="#">read more</a><b>02</b></div>,
    <div className="item" data-value="3"><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean pretium enim mauris, id posuere augue ullamcorper at. Nunc dignissim, purus quis lacinia pharetra, lorem odio volutpat velit,</small><a href="#">read more</a><b>03</b></div>,
    <div className="item" data-value="4"><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean pretium enim mauris, id posuere augue ullamcorper at. Nunc dignissim, purus quis lacinia pharetra, lorem odio volutpat velit,</small><a href="#">read more</a><b>04</b></div>,
    <div className="item" data-value="5"><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean pretium enim mauris, id posuere augue ullamcorper at. Nunc dignissim, purus quis lacinia pharetra, lorem odio volutpat velit,</small><a href="#">read more</a><b>05</b></div>,
];

const responsive = {
    0: { items: 1 },
    568: { items: 1 },
    1024: { items: 1 },
    1200: { items: 1 },
    1368: { items: 1 },
};

const Join = () => {

    return (
        <>
            <section className='joinBannerBg'>
                <div className='container'>
                    <AnimatedComponent animation="animate__slideInUp">
                        <div className='data'>
                            <p>Careers</p>
                            <h2>ACCELERATE YOUR <br />CAREER WITH ABRECO</h2>
                            <Link to="">JOB OPENING</Link>
                        </div>
                    </AnimatedComponent>
                    <img src={Dots} alt="" />
                </div>
            </section>

            <section className='joinAbreco'>
                <div className='container'>
                    <div className='data'>
                        <div className='testimonialsWrapper'>
                            <p>Why Join Abreco</p>
                            <h2>LEARN FROM <br />THE BEST</h2>
                            <img src={Dots2} alt="" />
                            <div className='testimonials'>
                                <AliceCarousel
                                    mouseTracking
                                    items={items}
                                    autoPlayautoPlayInterval={2000}
                                    infinite
                                    disableDotsControls
                                    responsive={responsive}
                                    renderPrevButton={() => {
                                        return <img src={JoinLeft} alt="" />
                                      }}
                                      renderNextButton={() => {
                                        return <img src={JoinRight} alt="" />
                                      }}
                                />
                            </div>
                        </div>
                        <div className='testimonialsImage'>
                            <img src={JoinImg} alt="" />
                        </div>
                    </div>
                </div>
            </section>
        </>
    )
}

export default Join