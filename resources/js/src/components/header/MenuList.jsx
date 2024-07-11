import React from 'react';
import assets from '../../assets';
import { Link } from 'react-router-dom';

export default function MenuList() {
    return (
        <div className='2xl:mt-10 mr-0 relative text-purple-500'>
            <ul className='p-6 bg-slate-100 2xl:bg-white 2xl:shadow-xl text-slate-700 rounded-2xl w-80 relative'>
                <li className='bg-slate-100 2xl:bg-white w-8 h-8 absolute -top-3 left-10 rotate-45 2xl:block hidden'></li>
                <DropdownItem
                    icon={assets.svg.team(22, 22)}
                    color='rgb(248 113 113)'
                    title='Team Management'
                    href='#'
                />
                <DropdownItem
                    icon={assets.svg.dollar(22, 18)}
                    color='rgb(74 222 128)'
                    title='Sales'
                    href='#'
                />
                <DropdownItem
                    icon={assets.svg.code(22, 18)}
                    color='rgb(168 85 247)'
                    title='Engineering'
                    href='#'
                />
                <DropdownItem
                    icon={assets.svg.design(22, 18, 'rgb(139 92 246)')}
                    title='Design'
                    href='#'
                />
                <DropdownItem
                    icon={assets.svg.edit(22, 18)}
                    color='rgb(244 63 94)'
                    title='Marketing'
                    href='#'
                />
                <DropdownItem
                    icon={assets.svg.dollar(22, 18)}
                    color='rgb(34 197 94)'
                    title='Money'
                    href='#'
                />
            </ul>
        </div>
    );
}

const DropdownItem = ({ icon, title, href, color }) => (
    <li className='p-2.5'>
        <Link to={href} className='flex gap-6 text-center'>
            <i style={{ fill: color, color }} className='font-light'>
                {icon}
            </i>
            <span className='text-sla-600 text-sm text-center duration-300 hover:text-slate-800'>
                {title}
            </span>
        </Link>
    </li>
);
