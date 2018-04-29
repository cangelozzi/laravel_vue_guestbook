<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Signature extends Model {
	/**
	 * Field to be mass-assigned.
	 *
	 * @var array
	 */

/* A mass-assignment vulnerability occurs when a user passes an unexpected HTTP parameter through a request, and that parameter changes a column in your database you did not expect. For example, a malicious user might send an is_admin parameter through an HTTP request, which is then passed into your model's create method, allowing the user to escalate themselves to an administrator. */

	protected $fillable = ['name', 'email', 'body', 'flagged_at'];

/**
 * Ignore flagged signatures.
 *
 * @param $query
 * @return mixed
 */
	public function scopeIgnoreFlagged($query) {
		return $query->where('flagged_at', null);
	}

	/**
	 * Flag the given signature.
	 *
	 * @return bool
	 */
	public function flag() {
		return $this->update(['flagged_at' => \Carbon\Carbon::now()]);
	}

/**
 * Get the user Gravatar by their email address.
 *
 * @return string
 */
	public function getAvatarAttribute() {
		return sprintf('https://www.gravatar.com/avatar/%s?s=100', md5($this->email));
	}

}
