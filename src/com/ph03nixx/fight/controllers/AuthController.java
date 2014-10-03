package com.ph03nixx.fight.controllers;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;

@Controller
public class AuthController {

	// LOGIN
	@RequestMapping(value = "/login", method = RequestMethod.GET)
	public String loginForm(Model model) {
		// display login name and offer to logout
		return "auth/login";
	}
	
	@RequestMapping(value = "/login", method=RequestMethod.POST)
	public String loginAction(Model model) {
		// TODO: do login
		return "auth/login";
	}
	
	// LOGOUT
	@RequestMapping(value = "/logout", method=RequestMethod.GET)
	public String logout(Model model) {
		// TODO: do logout
		return "auth/logout";
	}
	
	// REGISTER
	@RequestMapping(value = "/register", method=RequestMethod.GET)
	public String registerForm(Model model) {
		return "auth/register";
	}
	
	@RequestMapping(value = "/register", method=RequestMethod.POST)
	public String registerAction(Model model) {
		return "auth/register";
	}
	
	// CHANGE PASSWORD
	@RequestMapping(value ="/changepassword", method=RequestMethod.GET)
	public String changePasswordForm(Model model) {
		return "auth/changepassword";
	}
	
	@RequestMapping(value ="/changepassword", method=RequestMethod.POST)
	public String changePasswordAction(Model model) {
		return "auth/changepassword";
	}
}
