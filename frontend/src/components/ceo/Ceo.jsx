import React from 'react';
import './ceo.css';

import CEOImage from "../../images/ceo.webp";
import Quote from "../../images/quote.webp";
import Lines from "../../images/lines-2.webp";
import Dots from "../../images/dots-2.webp";

const Ceo = () => {
    return (
        <>
            <section className='pageTitle ceo'>
                <div className='container-fluid'>
                    <img src={Dots} className='dots' alt="dots" />
                    <div className='data'>
                        <div className='authorWrapper'>
                            <div className='title'>
                                <h2>MY DREAM WAS MY <br />DESTINATION</h2>
                            </div>
                            <div className='quote'>
                                <img src={Quote} alt="Quote" />
                                <p>My sense of purpose was clear, which pushed me forward to devise effective strategies for achieving my goals. In 2010, I took a small step into the freight forwarding industry and I put in my heart and soul to establish Abreco Freight as a trusted partner with a responsive logistics strategy that fulfills the logistic needs of customers.</p>
                            </div>
                            <div className='content'>
                                <p>My ultimate aim was not to give up on the underlying vision of total satisfaction for our employees, clients, and the community. Without further ado, I should thank each and every individual who stood as solid support and took my goals forward. Over time, we through our consistent effort grew into a big group comprising 25+ companies across 14 verticals. As the chief strategist, I adopt the approach that will best meet the needs of the organization and the business situation at hand. I am confident that our values of trust, transparency and team spirit will guide us and increase the value of our brand. To me, success is not a goal but feeling a sense of satisfaction in every step of our journey by being a trusted growth partner for our clients.</p>
                            </div>
                            <div className='authorBox'>
                                <h3>Mohammed Shaji</h3>
                                <p>Founder & CEO</p>
                            </div>
                        </div>
                        <div className='img'>
                            <img src={Lines} className='lines' alt="" />
                            <img src={CEOImage} className='ceoImage' alt="CEO" />
                        </div>
                    </div>
                </div>
            </section>
        </>
    )
}

export default Ceo