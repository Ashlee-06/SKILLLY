<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Skill;
use App\Models\CareerDomain;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    private function admin(): User
    {
        // Adjust 'is_admin' to your actual column name in the users table
        return User::factory()->create(['is_admin' => true]);
    }

    private function regularUser(): User
    {
        return User::factory()->create(['is_admin' => false]);
    }

    // =========================================================================
    // ACCESS CONTROL
    // =========================================================================

    // TC-ADM-01: Admin can access the dashboard
    public function test_admin_can_access_dashboard()
    {
        $response = $this->actingAs($this->admin())->get('/admin');
        $response->assertStatus(200);
    }

    // TC-ADM-02: Regular user gets 403 on /admin
    public function test_regular_user_cannot_access_admin_dashboard()
    {
        $response = $this->actingAs($this->regularUser())->get('/admin');
        $response->assertStatus(403);
    }

    // TC-ADM-03: Guest is redirected to login
    public function test_guest_is_redirected_to_login_from_admin()
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/login');
    }

    // TC-ADM-05: "Admin Panel" link visible only to admins
    public function test_admin_navbar_link_visible_only_to_admins()
    {
        $adminResponse = $this->actingAs($this->admin())->get('/');
        $adminResponse->assertSee('Admin Panel');

        $userResponse = $this->actingAs($this->regularUser())->get('/');
        $userResponse->assertDontSee('Admin Panel');
    }

    // =========================================================================
    // USERS
    // =========================================================================

    // TC-ADM-06: Admin can view the users list
    public function test_admin_can_view_users_list()
    {
        User::factory()->count(3)->create();

        $response = $this->actingAs($this->admin())->get('/admin/users');
        $response->assertStatus(200);
    }

    // TC-ADM-07: Admin user search filters results correctly
    public function test_admin_user_search_filters_results()
    {
        User::factory()->create(['name' => 'Alice Wonderland']);
        User::factory()->create(['name' => 'Bob Builder']);

        $response = $this->actingAs($this->admin())->get('/admin/users?search=Alice');

        $response->assertStatus(200);
        $response->assertSee('Alice Wonderland');
        $response->assertDontSee('Bob Builder');
    }

    // TC-ADM-10: Admin can delete a user
    public function test_admin_can_delete_user()
    {
        $admin  = $this->admin();
        $target = $this->regularUser();

        $response = $this->actingAs($admin)->delete("/admin/users/{$target->id}");

        $response->assertRedirect();
        $this->assertDatabaseMissing('users', ['id' => $target->id]);
    }

    // =========================================================================
    // SKILLS CRUD  (Model: App\Models\Skill)
    // =========================================================================

    // TC-ADM-12: Admin can create a skill
    public function test_admin_can_create_skill()
    {
        $response = $this->actingAs($this->admin())->post('/admin/skills', [
            'name'     => 'GraphQL',
            'type'     => 'technical',
            'keywords' => 'graphql, graph query language',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('skills', ['name' => 'GraphQL']);
    }

    // TC-ADM-13: Admin can edit a skill
    public function test_admin_can_edit_skill()
    {
        $skill = Skill::create([
            'name'     => 'Docker',
            'type'     => 'technical',
            'keywords' => 'docker',
        ]);

        $response = $this->actingAs($this->admin())->put("/admin/skills/{$skill->id}", [
            'name'     => 'Docker',
            'type'     => 'technical',
            'keywords' => 'docker, container, containerization',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('skills', [
            'id'       => $skill->id,
            'keywords' => 'docker, container, containerization',
        ]);
    }

    // TC-ADM-14: Admin can delete a skill
    public function test_admin_can_delete_skill()
    {
        $skill = Skill::create([
            'name'     => 'OldSkill',
            'type'     => 'technical',
            'keywords' => 'old',
        ]);

        $response = $this->actingAs($this->admin())->delete("/admin/skills/{$skill->id}");

        $response->assertRedirect();
        $this->assertDatabaseMissing('skills', ['id' => $skill->id]);
    }

    // TC-ADM-15: Skills list page loads
    public function test_admin_skills_list_loads()
    {
        $response = $this->actingAs($this->admin())->get('/admin/skills');
        $response->assertStatus(200);
    }

    // TC-ADM-16: Skills create page loads
    public function test_admin_skills_create_page_loads()
    {
        $response = $this->actingAs($this->admin())->get('/admin/skills/create');
        $response->assertStatus(200);
    }

    // =========================================================================
    // CAREER DOMAINS CRUD  (Model: App\Models\CareerDomain)
    // =========================================================================

    // TC-ADM-19: Admin can create a career domain
    public function test_admin_can_create_career_domain()
    {
        $response = $this->actingAs($this->admin())->post('/admin/careers', [
            'name' => 'Blockchain Developer',
            // Add any other fields your CareerDomain form requires
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('career_domains', ['name' => 'Blockchain Developer']);
    }

    // TC-ADM-22: Admin can edit a career domain
    public function test_admin_can_edit_career_domain()
    {
        $career = CareerDomain::create(['name' => 'Old Career Name']);

        $response = $this->actingAs($this->admin())->put("/admin/careers/{$career->id}", [
            'name' => 'Updated Career Name',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('career_domains', [
            'id'   => $career->id,
            'name' => 'Updated Career Name',
        ]);
    }

    // TC-ADM-25: Admin can delete a career domain
    public function test_admin_can_delete_career_domain()
    {
        $career = CareerDomain::create(['name' => 'ObsoleteCareer']);

        $response = $this->actingAs($this->admin())->delete("/admin/careers/{$career->id}");

        $response->assertRedirect();
        $this->assertDatabaseMissing('career_domains', ['id' => $career->id]);
    }

    // TC-ADM-23: Career domains list page loads
    public function test_admin_career_domains_list_loads()
    {
        $response = $this->actingAs($this->admin())->get('/admin/careers');
        $response->assertStatus(200);
    }

    // TC-ADM-24: Career domains create page loads
    public function test_admin_career_domains_create_page_loads()
    {
        $response = $this->actingAs($this->admin())->get('/admin/careers/create');
        $response->assertStatus(200);
    }

    // =========================================================================
    // ANALYSES
    // =========================================================================

    // TC-ADM-04: Admin can view all analyses
    public function test_admin_can_view_all_analyses()
    {
        $response = $this->actingAs($this->admin())->get('/admin/analyses');
        $response->assertStatus(200);
    }
}